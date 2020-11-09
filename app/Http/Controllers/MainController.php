<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Contracts\HelperContract; 
use Auth;
use Session; 
use Cookie;
use Validator; 
use Carbon\Carbon;
use App\User; 
//use Codedge\Fpdf\Fpdf\Fpdf;
use PDF;

class MainController extends Controller {

	protected $helpers; //Helpers implementation
    
    public function __construct(HelperContract $h)
    {
    	$this->helpers = $h;                      
    }

	
	/**
	 * Show the application home page.
	 *
	 * @return Response
	 */
	public function getIndex(Request $request)
    {
		$user = null;
		$nope = false;
		$v = "";
		
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins();
		#$this->helpers->populateTips();
        $cpt = ['user','signals','plugins'];
				
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$v = "index";
				$orders = $this->helpers->getAllOrders();
				$stats = $this->helpers->getSiteStats();
				$tph = $this->helpers->getTopPerformingHosts();
				$req = $request->all();
                array_push($cpt,'orders');				
                array_push($cpt,'stats');				
                array_push($cpt,'tph');				
			}
			else
			{
				$u = "http://etukng.tobi-demos.tk";
				return redirect()->away($u);
			}
		}
		else
		{
			$v = "login";
		}
		return view($v,compact($cpt));
		
    }
	
	
	/**
	 * Show list of registered users on the platform.
	 *
	 * @return Response
	 */
	public function getUsers(Request $request)
    {
		$user = null;
		$nope = false;
		$v = "";
		
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins();
		#$this->helpers->populateTips();
        $cpt = ['user','signals','plugins'];
				
		if(Auth::check())
		{
			
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$hasPermission = $this->helpers->hasPermission($user->id,['view_users']);
				#dd($hasPermission);
				$req = $request->all();
				
				if($hasPermission)
				{
				$v = "users";
				$req = $request->all();
                $users = $this->helpers->getUsers();
				#dd($users);
                array_push($cpt,'users');
                }
				else
				{
					session()->flash("permissions-status-error","ok");
					return redirect()->intended('/');
				}				
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			$v = "login";
		}
		return view($v,compact($cpt));
    }
	
	/**
	 * Show details of a registered user on the platform.
	 *
	 * @return Response
	 */
	public function getUser(Request $request)
    {
		$user = null;
		$nope = false;
		$v = "";
		
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins();
		#$this->helpers->populateTips();
        $cpt = ['user','signals','plugins'];
				
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$hasPermission = $this->helpers->hasPermission($user->id,['view_users']);
				#dd($hasPermission);
				$req = $request->all();
				
				if($hasPermission)
				{
				if(isset($req['xf']))
				{
					$xf = $req['xf'];
					$v = "user";
					$uu = User::where('id',$xf)
					          ->orWhere('email',$xf)->first();
							  
					if($uu == null)
					{
						session()->flash("invalid-user-status-error","ok");
						return redirect()->intended('users');
					}
				    $u = $this->helpers->getUser($xf);
					
					if(count($u) < 1)
					{
						session()->flash("invalid-user-status-error","ok");
						return redirect()->intended('users');
					}
					else
					{
						$users = [];
						$apts = $this->helpers->getApartments($uu);
					    $reviews = $this->helpers->getReviews($uu->id,"user");
					    $permissions = $this->helpers->getPermissions($uu);
						#dd(count($reviews));
                        array_push($cpt,'u');
                        array_push($cpt,'apts');
                        array_push($cpt,'reviews');
                        array_push($cpt,'users');
                        array_push($cpt,'permissions');
					}
					
				}
				else
				{
					session()->flash("validation-status-error","ok");
					return redirect()->intended('users');
				}
				}
				else
				{
					session()->flash("permissions-status-error","ok");
					return redirect()->intended('/');
				}
								
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			$v = "login";
		}
		return view($v,compact($cpt));
    }
	
	
	/**
	 * Handle update user.
	 *
	 * @return Response
	 */
	public function postUser(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$hasPermission = $this->helpers->hasPermission($user->id,['view_users','edit_users']);
				#dd($hasPermission);
				$req = $request->all();
				
				if($hasPermission)
				{
				
				$validator = Validator::make($req,[
		                    'fname' => 'required',
		                    'lname' => 'required',
		                    'phone' => 'required|numeric',
		                    'email' => 'required|email',
		                    'role' => 'required|not_in:none',
		                    'status' => 'required|not_in:none'
		                   ]);
						
				if($validator->fails())
                {
                  session()->flash("validation-status-error","ok");
			      return redirect()->back()->withInput();
                }
				else
				{
					$ret = $this->helpers->updateUser($req);
					$ss = "update-user-status";
					if($ret == "error") $ss .= "-error";
					session()->flash($ss,"ok");
			        return redirect()->back();
				}
				}
				else
				{
					session()->flash("permissions-status-error","ok");
					return redirect()->intended('/');
				}
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			return redirect()->intended('/');
		}
    }
	
	/**
	 * Handle Enable/Disable user.
	 *
	 * @return Response
	 */
	public function getEnableDisableUser(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$hasPermission = $this->helpers->hasPermission($user->id,['view_users','edit_users']);
				#dd($hasPermission);
				$req = $request->all();
				
				if($hasPermission)
				{
				$validator = Validator::make($req,[
		                    'xf' => 'required|numeric',
		                    'type' => 'required',
		                   ]);
						
				if($validator->fails())
                {
                  session()->flash("validation-status-error","ok");
			      return redirect()->back()->withInput();
                }
				else
				{
					$ret = $this->helpers->updateEDU($req);
					$ss = "update-user-status";
					if($ret == "error") $ss .= "-error";
					session()->flash($ss,"ok");
			        return redirect()->back();
				}
				}
				else
				{
					session()->flash("permissions-status-error","ok");
					return redirect()->intended('/');
				}
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			return redirect()->intended('/');
		}
    }
	
	/**
	 * Show the Add Permission view.
	 *
	 * @return Response
	 */
	public function getAddPermission(Request $request)
    {
		$user = null;
		$nope = false;
		$v = "";
		
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins();
		$permissions = $this->helpers->permissions;
		#$this->helpers->populateTips();
        $cpt = ['user','signals','plugins'];
				
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$hasPermission = $this->helpers->hasPermission($user->id,['view_users','edit_users']);
				#dd($hasPermission);
				$req = $request->all();
				
				if($hasPermission)
				{
                
				if(isset($req['xf']))
				{
					$xf = $req['xf'];
					$v = "add-permissions";
					$uu = User::where('id',$xf)
					          ->orWhere('email',$xf)->first();
							  
					if($uu == null)
					{
						session()->flash("invalid-user-status-error","ok");
						return redirect()->intended('users');
					}
				    $u = $this->helpers->getUser($xf);
					
					if(count($u) < 1)
					{
						session()->flash("invalid-user-status-error","ok");
						return redirect()->intended('users');
					}
					else
					{
						array_push($cpt,'u');                       
						array_push($cpt,'permissions');                       
					}
					
				}
				else
				{
					session()->flash("validation-status-error","ok");
					return redirect()->intended('users');
				}
				}
				else
				{
					session()->flash("permissions-status-error","ok");
					return redirect()->intended('/');
				}
								
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			$v = "login";
		}
		return view($v,compact($cpt));
    }
	
	/**
	 * Handle add permission.
	 *
	 * @return Response
	 */
	public function postAddPermission(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$hasPermission = $this->helpers->hasPermission($user->id,['view_users','edit_users']);
				#dd($hasPermission);
				$req = $request->all();
				
				if($hasPermission)
				{
				
				#dd($req);
				
				$validator = Validator::make($req,[
		                    'xf' => 'required',
		                    'pp' => 'required'
		                   ]);
						
				if($validator->fails())
                {
                  session()->flash("validation-status-error","ok");
			      return redirect()->back()->withInput();
                }
				else
				{
					$pp = json_decode($req['pp']);
					$ptags = [];
					
					foreach($pp as $p)
					{
						if($p->selected) array_push($ptags,$p->ptag);
					}
					
					$dt = [
					     'xf' => $req['xf'],
					     'ptags' => $ptags,
					     'granted_by' => $user->id
					   ];
					   
					$ret = $this->helpers->addPermissions($dt);
					$ss = "add-permissions-status";
					if($ret == "error") $ss .= "-error";
					session()->flash($ss,"ok");
			        return redirect()->intended("user?xf=".$req['xf']);
				}
				}
				else
				{
					session()->flash("permissions-status-error","ok");
					return redirect()->intended("/");
				}
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			return redirect()->intended('/');
		}
    }
	
	/**
	 * Handle remove permission.
	 *
	 * @return Response
	 */
	public function getRemovePermission(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$req = $request->all();
			   	    #dd($req);
				$hasPermission = $this->helpers->hasPermission($user->id,['view_users','edit_users']);
				#dd($hasPermission);
				
				if($hasPermission)
				{
				
				    $validator = Validator::make($req,[
		                    'xf' => 'required',
		                    'p' => 'required',
		                   ]);
						
				    if($validator->fails())
                    {
                      session()->flash("validation-status-error","ok");
			          return redirect()->back()->withInput();
                    }
				    else
				    {   
					  $ret = $this->helpers->removePermission($req);
					  $ss = "remove-permission-status";
					  if($ret == "error") $ss .= "-error";
					  session()->flash($ss,"ok");
			          return redirect()->intended("user?xf=".$req['xf']);
				    }
				}
				else
				{
					session()->flash("permissions-status-error","ok");
			        return redirect()->intended("/");
				}
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			return redirect()->intended('/');
		}
    }
	
	
	/**
	 * Show list of reviews.
	 *
	 * @return Response
	 */
	public function getReviews(Request $request)
    {
		$user = null;
		$nope = false;
		$v = "";
		
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins();
		#$this->helpers->populateTips();
        $cpt = ['user','signals','plugins'];
				
		if(Auth::check())
		{
			
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$hasPermission = $this->helpers->hasPermission($user->id,['view_reviews']);
				#dd($hasPermission);
				$req = $request->all();
				
				if($hasPermission)
				{
				$v = "reviews";
				$req = $request->all();
                $reviews = $this->helpers->getAllReviews();
				#dd($reviews);
                array_push($cpt,'reviews');
                }
				else
				{
					session()->flash("permissions-status-error","ok");
					return redirect()->intended('/');
				}				
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			$v = "login";
		}
		return view($v,compact($cpt));
    }
	
	/**
	 * Handle approve/reject review.
	 *
	 * @return Response
	 */
	public function getApproveRejectReview(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$req = $request->all();
			   	    #dd($req);
				$hasPermission = $this->helpers->hasPermission($user->id,['view_reviews','edit_reviews']);
				#dd($hasPermission);
				
				if($hasPermission)
				{
				
				    $validator = Validator::make($req,[
		                    'xf' => 'required',
		                    'type' => 'required',
		                   ]);
						
				    if($validator->fails())
                    {
                      session()->flash("validation-status-error","ok");
			          return redirect()->back()->withInput();
                    }
				    else
				    {   
					  $dt = ['id' => $req['xf'],'status' => ""];
					  $dt['status'] = $req['type'] == "approve" ? "approved" : "rejected";
					  $ret = $this->helpers->updateReviewStatus($dt);
					  $ss = "update-review-status";
					  if($ret == "error") $ss .= "-error";
					  session()->flash($ss,"ok");
			          return redirect()->intended("reviews");
				    }
				}
				else
				{
					session()->flash("permissions-status-error","ok");
			        return redirect()->intended("/");
				}
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			return redirect()->intended('/');
		}
    }
	
	/**
	 * Handle remove review.
	 *
	 * @return Response
	 */
	public function getRemoveReview(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$req = $request->all();
			   	    #dd($req);
				$hasPermission = $this->helpers->hasPermission($user->id,['view_reviews','edit_reviews']);
				#dd($hasPermission);
				
				if($hasPermission)
				{
				
				    $validator = Validator::make($req,[
		                    'xf' => 'required'
		                   ]);
						
				    if($validator->fails())
                    {
                      session()->flash("validation-status-error","ok");
			          return redirect()->back()->withInput();
                    }
				    else
				    {   
					  $ret = $this->helpers->removeReview($req);
					  $ss = "remove-review-status";
					  if($ret == "error") $ss .= "-error";
					  session()->flash($ss,"ok");
			          return redirect()->intended("reviews");
				    }
				}
				else
				{
					session()->flash("permissions-status-error","ok");
			        return redirect()->intended("/");
				}
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			return redirect()->intended('/');
		}
    }
	
	
	/**
	 * Show list of plugins.
	 *
	 * @return Response
	 */
	public function getPlugins(Request $request)
    {
		$user = null;
		$nope = false;
		$v = "";
		
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins();
		#$this->helpers->populateTips();
        $cpt = ['user','signals','plugins'];
				
		if(Auth::check())
		{
			
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$hasPermission = $this->helpers->hasPermission($user->id,['view_plugins']);
				#dd($hasPermission);
				$req = $request->all();
				
				if($hasPermission)
				{
				 $v = "plugins";
				}
				else
				{
					session()->flash("permissions-status-error","ok");
					return redirect()->intended('/');
				}				
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			$v = "login";
		}
		return view($v,compact($cpt));
    }
	
	
	/**
	 * Show the Add Plugin view.
	 *
	 * @return Response
	 */
	public function getAddPlugin(Request $request)
    {
		$user = null;
		$nope = false;
		$v = "";
		
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins();
		$cpt = ['user','signals','plugins'];
				
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$hasPermission = $this->helpers->hasPermission($user->id,['view_plugins','edit_plugins']);
				#dd($hasPermission);
				$req = $request->all();
				
				if($hasPermission)
				{
					$v = "add-plugin";
				}
				else
				{
					session()->flash("permissions-status-error","ok");
					return redirect()->intended('/');
				}
								
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			$v = "login";
		}
		return view($v,compact($cpt));
    }
	
	/**
	 * Handle add plugin.
	 *
	 * @return Response
	 */
	public function postAddPlugin(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$hasPermission = $this->helpers->hasPermission($user->id,['view_plugins','edit_plugins']);
				#dd($hasPermission);
				$req = $request->all();
				
				if($hasPermission)
				{
				
				#dd($req);
				
				$validator = Validator::make($req,[
		                    'status' => 'required|not_in:none',
                             'name' => 'required',
                             'value' => 'required'
		                   ]);
						
				if($validator->fails())
                {
                  session()->flash("validation-status-error","ok");
			      return redirect()->back()->withInput();
                }
				else
				{
					$ret = $this->helpers->createPlugin($req);
					$ss = "add-plugin-status";
					if($ret == "error") $ss .= "-error";
					session()->flash($ss,"ok");
			        return redirect()->intended("plugins");
				}
				}
				else
				{
					session()->flash("permissions-status-error","ok");
					return redirect()->intended("/");
				}
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			return redirect()->intended('/');
		}
    }
	
	
	/**
	 * Show the Edit Plugin view.
	 *
	 * @return Response
	 */
	public function getPlugin(Request $request)
    {
		$user = null;
		$nope = false;
		$v = "";
		
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins();
		$permissions = $this->helpers->permissions;
		#$this->helpers->populateTips();
        $cpt = ['user','signals','plugins'];
				
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$hasPermission = $this->helpers->hasPermission($user->id,['view_plugins','edit_plugins']);
				#dd($hasPermission);
				$req = $request->all();
				
				if($hasPermission)
				{
                
				if(isset($req['s']))
				{
					$v = "plugin";
					$p = $this->helpers->getPlugin($req['s']);
					
					if(count($p) < 1)
					{
						session()->flash("validation-status-error","ok");
						return redirect()->intended('plugins');
					}
					else
					{
						array_push($cpt,'p');                                 
					}
					
				}
				else
				{
					session()->flash("validation-status-error","ok");
					return redirect()->intended('plugins');
				}
				}
				else
				{
					session()->flash("permissions-status-error","ok");
					return redirect()->intended('/');
				}
								
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			$v = "login";
		}
		return view($v,compact($cpt));
    }
	
	
	/**
	 * Handle edit plugin.
	 *
	 * @return Response
	 */
	public function postPlugin(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$hasPermission = $this->helpers->hasPermission($user->id,['view_plugins','edit_plugins']);
				#dd($hasPermission);
				$req = $request->all();
				
				if($hasPermission)
				{
				
				#dd($req);
				
				$validator = Validator::make($req,[
		                    'status' => 'required|not_in:none',
                             'xf' => 'required|numeric',
                             'name' => 'required',
                             'value' => 'required'
		                   ]);
						
				if($validator->fails())
                {
                  session()->flash("validation-status-error","ok");
			      return redirect()->back()->withInput();
                }
				else
				{
					$ret = $this->helpers->updatePlugin($req);
					$ss = "update-plugin-status";
					if($ret == "error") $ss .= "-error";
					session()->flash($ss,"ok");
			        return redirect()->intended("plugins");
				}
				}
				else
				{
					session()->flash("permissions-status-error","ok");
					return redirect()->intended("/");
				}
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			return redirect()->intended('/');
		}
    }
	
	
	/**
	 * Handle remove plugin.
	 *
	 * @return Response
	 */
	public function getRemovePlugin(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$req = $request->all();
			   	    #dd($req);
				$hasPermission = $this->helpers->hasPermission($user->id,['view_plugins','edit_plugins']);
				#dd($hasPermission);
				
				if($hasPermission)
				{
				
				    $validator = Validator::make($req,[
		                    's' => 'required'
		                   ]);
						
				    if($validator->fails())
                    {
                      session()->flash("validation-status-error","ok");
			          return redirect()->back()->withInput();
                    }
				    else
				    {   
					  $ret = $this->helpers->removePlugin($req['s']);
					  $ss = "remove-plugin-status";
					  if($ret == "error") $ss .= "-error";
					  session()->flash($ss,"ok");
			          return redirect()->intended("plugins");
				    }
				}
				else
				{
					session()->flash("permissions-status-error","ok");
			        return redirect()->intended("/");
				}
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			return redirect()->intended('/');
		}
    }
	
	
	/**
	 * Show list of transactions on the platform.
	 *
	 * @return Response
	 */
	public function getTransactions(Request $request)
    {
		$user = null;
		$nope = false;
		$v = "";
		
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins();
		#$this->helpers->populateTips();
        $cpt = ['user','signals','plugins'];
				
		if(Auth::check())
		{
			
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$hasPermission = $this->helpers->hasPermission($user->id,['view_transactions']);
				#dd($hasPermission);
				$req = $request->all();
				
				if($hasPermission)
				{
				$v = "transactions";
				$req = $request->all();
                $transactions = $this->helpers->getAllTransactions();
				#dd($transactions);
                array_push($cpt,'transactions');
                }
				else
				{
					session()->flash("permissions-status-error","ok");
					return redirect()->intended('/');
				}				
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			$v = "login";
		}
		return view($v,compact($cpt));
    }
	
	/**
	 * Show the View Transaction view.
	 *
	 * @return Response
	 */
	public function getTransaction(Request $request)
    {
		$user = null;
		$nope = false;
		$v = "";
		
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins();
		$permissions = $this->helpers->permissions;
		#$this->helpers->populateTips();
        $cpt = ['user','signals','plugins'];
				
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$hasPermission = $this->helpers->hasPermission($user->id,['view_transactions','edit_transactions']);
				#dd($hasPermission);
				$req = $request->all();
				
				if($hasPermission)
				{
                
				if(isset($req['xf']))
				{
					$v = "transaction";
					$t = $this->helpers->getTransaction($req['xf'],['guest' => true]);
					#dd($t);
					if(count($t) < 1)
					{
						session()->flash("validation-status-error","ok");
						return redirect()->intended('transactions');
					}
					else
					{
						array_push($cpt,'t');                                 
					}
					
				}
				else
				{
					session()->flash("validation-status-error","ok");
					return redirect()->intended('transactions');
				}
				}
				else
				{
					session()->flash("permissions-status-error","ok");
					return redirect()->intended('/');
				}
								
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			$v = "login";
		}
		return view($v,compact($cpt));
    }
	
	
	/**
	 * Show list of transactions on the platform.
	 *
	 * @return Response
	 */
	public function getTickets(Request $request)
    {
		$user = null;
		$nope = false;
		$v = "";
		
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins();
		#$this->helpers->populateTips();
        $cpt = ['user','signals','plugins'];
				
		if(Auth::check())
		{
			
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$hasPermission = $this->helpers->hasPermission($user->id,['view_tickets']);
				#dd($hasPermission);
				$req = $request->all();
				
				if($hasPermission)
				{
				$v = "tickets";
				$req = $request->all();
                $tickets = $this->helpers->getAllTickets();
				#dd($tickets);
                array_push($cpt,'tickets');
                }
				else
				{
					session()->flash("permissions-status-error","ok");
					return redirect()->intended('/');
				}				
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			$v = "login";
		}
		return view($v,compact($cpt));
    }
	
	
	/**
	 * Show the Add Ticket view.
	 *
	 * @return Response
	 */
	public function getAddTicket(Request $request)
    {
		$user = null;
		$nope = false;
		$v = "";
		
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins();
		$cpt = ['user','signals','plugins'];
				
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$hasPermission = $this->helpers->hasPermission($user->id,['view_tickets','edit_tickets']);
				#dd($hasPermission);
				$req = $request->all();
				
				if($hasPermission)
				{
					$v = "add-ticket";
				}
				else
				{
					session()->flash("permissions-status-error","ok");
					return redirect()->intended('/');
				}
								
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			$v = "login";
		}
		return view($v,compact($cpt));
    }
	
	/**
	 * Handle add ticket.
	 *
	 * @return Response
	 */
	public function postAddTicket(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$hasPermission = $this->helpers->hasPermission($user->id,['view_tickets','edit_tickets']);
				#dd($hasPermission);
				$req = $request->all();
				
				if($hasPermission)
				{
				
				#dd($req);
				
				$validator = Validator::make($req,[
		                    'type' => 'required|not_in:none',
                             'email' => 'required|email',
                             'subject' => 'required',
                             'msg' => 'required'
		                   ]);
						
				if($validator->fails())
                {
                  session()->flash("validation-status-error","ok");
			      return redirect()->back()->withInput();
                }
				else
				{
					$req['added_by'] = $user->id;
					$ret = $this->helpers->addTicket($req);
					$ss = "add-ticket-status";
					if($ret == "error") $ss .= "-error";
					session()->flash($ss,"ok");
			        return redirect()->intended("tickets");
				}
				}
				else
				{
					session()->flash("permissions-status-error","ok");
					return redirect()->intended("/");
				}
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			return redirect()->intended('/');
		}
    }
	
	/**
	 * Show the View Ticket view.
	 *
	 * @return Response
	 */
	public function getTicket(Request $request)
    {
		$user = null;
		$nope = false;
		$v = "";
		
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins();
		$permissions = $this->helpers->permissions;
		#$this->helpers->populateTips();
        $cpt = ['user','signals','plugins'];
				
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$hasPermission = $this->helpers->hasPermission($user->id,['view_tickets','edit_tickets']);
				#dd($hasPermission);
				$req = $request->all();
				
				if($hasPermission)
				{
                
				if(isset($req['xf']))
				{
					$v = "ticket";
					$t = $this->helpers->getTicket($req['xf']);
					#dd($t);
					if(count($t) < 1)
					{
						session()->flash("validation-status-error","ok");
						return redirect()->intended('tickets');
					}
					else
					{
						array_push($cpt,'t');                                 
					}
					
				}
				else
				{
					session()->flash("validation-status-error","ok");
					return redirect()->intended('tickets');
				}
				}
				else
				{
					session()->flash("permissions-status-error","ok");
					return redirect()->intended('/');
				}
								
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			$v = "login";
		}
		return view($v,compact($cpt));
    }
	
	/**
	 * Show the Update Ticket view.
	 *
	 * @return Response
	 */
	public function getUpdateTicket(Request $request)
    {
		$user = null;
		$nope = false;
		$v = "";
		
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins();
		$permissions = $this->helpers->permissions;
		#$this->helpers->populateTips();
        $cpt = ['user','signals','plugins'];
				
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$hasPermission = $this->helpers->hasPermission($user->id,['view_tickets','edit_tickets']);
				#dd($hasPermission);
				$req = $request->all();
				
				if($hasPermission)
				{
                
				if(isset($req['xf']))
				{
					$v = "update-ticket";
					$t = $this->helpers->getTicket($req['xf']);
					#dd($t);
					if(count($t) < 1)
					{
						session()->flash("validation-status-error","ok");
						return redirect()->intended('tickets');
					}
					else
					{
						array_push($cpt,'t');                                 
					}
					
				}
				else
				{
					session()->flash("validation-status-error","ok");
					return redirect()->intended('tickets');
				}
				}
				else
				{
					session()->flash("permissions-status-error","ok");
					return redirect()->intended('/');
				}
								
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			$v = "login";
		}
		return view($v,compact($cpt));
    }
	
	
	/**
	 * Handle update ticket.
	 *
	 * @return Response
	 */
	public function postUpdateTicket(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$hasPermission = $this->helpers->hasPermission($user->id,['view_tickets','edit_tickets']);
				#dd($hasPermission);
				$req = $request->all();
				
				if($hasPermission)
				{
				
				#dd($req);
				
				$validator = Validator::make($req,[
		                    'xf' => 'required',
                             'msg' => 'required'
		                   ]);
						
				if($validator->fails())
                {
                  session()->flash("validation-status-error","ok");
			      return redirect()->back()->withInput();
                }
				else
				{
					$req['added_by'] = $user->id;
					$ret = $this->helpers->updateTicket($req);
					$ss = "update-ticket-status";
					if($ret == "error") $ss .= "-error";
					session()->flash($ss,"ok");
					$uu = "ticket?xf=".$req['xf'];
			        return redirect()->intended($uu);
				}
				}
				else
				{
					session()->flash("permissions-status-error","ok");
					return redirect()->intended("/");
				}
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			return redirect()->intended('/');
		}
    }
	
	
	/**
	 * Handle remove ticket.
	 *
	 * @return Response
	 */
	public function getRemoveTicket(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$req = $request->all();
			   	    #dd($req);
				$hasPermission = $this->helpers->hasPermission($user->id,['view_plugins','edit_plugins']);
				#dd($hasPermission);
				
				if($hasPermission)
				{
				
				    $validator = Validator::make($req,[
		                    'xf' => 'required'
		                   ]);
						
				    if($validator->fails())
                    {
                      session()->flash("validation-status-error","ok");
			          return redirect()->back()->withInput();
                    }
				    else
				    {   
					  $ret = $this->helpers->removeTicket($req['xf']);
					  $ss = "remove-ticket-status";
					  if($ret == "error") $ss .= "-error";
					  session()->flash($ss,"ok");
			          return redirect()->intended("tickets");
				    }
				}
				else
				{
					session()->flash("permissions-status-error","ok");
			        return redirect()->intended("/");
				}
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			return redirect()->intended('/');
		}
    }
	
	
	/**
	 * Show list of banners.
	 *
	 * @return Response
	 */
	public function getBanners(Request $request)
    {
		$user = null;
		$nope = false;
		$v = "";
		
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins();
		
		#$this->helpers->populateTips();
        $cpt = ['user','signals','plugins'];
				
		if(Auth::check())
		{
			
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$hasPermission = $this->helpers->hasPermission($user->id,['view_banners']);
				#dd($hasPermission);
				$req = $request->all();
				
				if($hasPermission)
				{
				 $v = "banners";
				 $banners = $this->helpers->getBanners();
				 array_push($cpt,'banners');
				}
				else
				{
					session()->flash("permissions-status-error","ok");
					return redirect()->intended('/');
				}				
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			$v = "login";
		}
		return view($v,compact($cpt));
    }
	
	
	/**
	 * Show the Add Banner view.
	 *
	 * @return Response
	 */
	public function getAddBanner(Request $request)
    {
		$user = null;
		$nope = false;
		$v = "";
		
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins();
		$cpt = ['user','signals','plugins'];
				
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$hasPermission = $this->helpers->hasPermission($user->id,['view_plugins','edit_plugins']);
				#dd($hasPermission);
				$req = $request->all();
				
				if($hasPermission)
				{
					$v = "add-plugin";
				}
				else
				{
					session()->flash("permissions-status-error","ok");
					return redirect()->intended('/');
				}
								
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			$v = "login";
		}
		return view($v,compact($cpt));
    }
	
	/**
	 * Handle add banner.
	 *
	 * @return Response
	 */
	public function postAddBanner(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$hasPermission = $this->helpers->hasPermission($user->id,['view_plugins','edit_plugins']);
				#dd($hasPermission);
				$req = $request->all();
				
				if($hasPermission)
				{
				
				#dd($req);
				
				$validator = Validator::make($req,[
		                    'status' => 'required|not_in:none',
                             'name' => 'required',
                             'value' => 'required'
		                   ]);
						
				if($validator->fails())
                {
                  session()->flash("validation-status-error","ok");
			      return redirect()->back()->withInput();
                }
				else
				{
					$ret = $this->helpers->createPlugin($req);
					$ss = "add-plugin-status";
					if($ret == "error") $ss .= "-error";
					session()->flash($ss,"ok");
			        return redirect()->intended("plugins");
				}
				}
				else
				{
					session()->flash("permissions-status-error","ok");
					return redirect()->intended("/");
				}
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			return redirect()->intended('/');
		}
    }
	
	/**
	 * Handle update banner.
	 *
	 * @return Response
	 */
	public function getUpdateBanner(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$hasPermission = $this->helpers->hasPermission($user->id,['view_plugins','edit_plugins']);
				#dd($hasPermission);
				$req = $request->all();
				
				if($hasPermission)
				{
				
				#dd($req);
				
				$validator = Validator::make($req,[
		                    'status' => 'required|not_in:none',
                             'xf' => 'required|numeric',
                             'name' => 'required',
                             'value' => 'required'
		                   ]);
						
				if($validator->fails())
                {
                  session()->flash("validation-status-error","ok");
			      return redirect()->back()->withInput();
                }
				else
				{
					$ret = $this->helpers->updatePlugin($req);
					$ss = "update-plugin-status";
					if($ret == "error") $ss .= "-error";
					session()->flash($ss,"ok");
			        return redirect()->intended("plugins");
				}
				}
				else
				{
					session()->flash("permissions-status-error","ok");
					return redirect()->intended("/");
				}
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			return redirect()->intended('/');
		}
    }
	
	
	/**
	 * Handle remove banner.
	 *
	 * @return Response
	 */
	public function getRemoveBanner(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($this->helpers->isAdmin($user))
			{
				$req = $request->all();
			   	    #dd($req);
				$hasPermission = $this->helpers->hasPermission($user->id,['view_plugins','edit_plugins']);
				#dd($hasPermission);
				
				if($hasPermission)
				{
				
				    $validator = Validator::make($req,[
		                    's' => 'required'
		                   ]);
						
				    if($validator->fails())
                    {
                      session()->flash("validation-status-error","ok");
			          return redirect()->back()->withInput();
                    }
				    else
				    {   
					  $ret = $this->helpers->removePlugin($req['s']);
					  $ss = "remove-plugin-status";
					  if($ret == "error") $ss .= "-error";
					  session()->flash($ss,"ok");
			          return redirect()->intended("plugins");
				    }
				}
				else
				{
					session()->flash("permissions-status-error","ok");
			        return redirect()->intended("/");
				}
			}
			else
			{
				Auth::logout();
				$u = url('/');
				return redirect()->intended($u);
			}
		}
		else
		{
			return redirect()->intended('/');
		}
    }
	
	
	
	
	
	
	
/**
	 * Switch user mode (host/guest).
	 *
	 * @return Response
	 */
	public function getTestBomb(Request $request)
    {
		$user = null;
		$messages = [];
		$ret = ['status' => "error", 'message' => "nothing happened"];
		
		if(Auth::check())
		{
			$user = Auth::user();
			$messages = $this->helpers->getMessages(['user_id' => $user->id]);
		}
		else
		{
			$ret['message'] = "auth";
		}
		
		$req = $request->all();
		
		$validator = Validator::make($req, [
                             'type' => 'required',
                             'method' => 'required',
                             'url' => 'required'
         ]);
         
         if($validator->fails())
         {
             $ret['message'] = "validation";
         }
		 else
		 {
       $rr = [
          'data' => [],
          'headers' => [],
          'url' => $req['url'],
          'method' => $req['method']
         ];
      
      $dt = [];
      
		   switch($req['type'])
		   {
		     case "bvn":
		       /**
			   $rr['data'] = [
		         'bvn' => $req['bvn'],
		         'account_number' => $req['account_number'],
		        'bank_code' => $req['bank_code'],
		         ];
		       **/  
			   //localhost:8000/tb?url=https://api.paystack.co/bank/resolve_bvn/:22181211888&method=get&type=bvn
		         $rr['headers'] = [
		           'Authorization' => "Bearer ".env("PAYSTACK_SECRET_KEY")
		           ];
		     break;
		   }
		   
			$ret = $this->helpers->bomb($rr);
			 
		 }
		 
		 dd($ret);
    }
	
	
	

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getZoho()
    {
        $ret = "97916613";
    	return $ret;
    }
	
	

	
}
