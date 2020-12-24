<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\massage\Message;
use App\Models\audio\Audio;
use App\Models\comment_likes\Comment_like;
use App\Models\hashtag\Hashtag;
use App\Models\massage\Massage;
use App\Models\tag\Tag;
use App\Models\user_followed\User_followed as User_followedUser_followed;
use App\Models\video\Video;
use App\Models\video_mention\Video_mention;
use App\Models\video_tags\video_tags;
use App\tags\Tags;
use App\User;
use App\Models\user_followed\user_followed;
use App\Models\video_comments\Video_Comments;
use Egulias\EmailValidator\Warning\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function logout()
    {
        # code...
        Auth::logout(); 
        return $this->sendResponse(200, 'logout successfully!');
    }
    public function login(Request $request)
    {
        
        try {
            //Request input Validation
            
            $validation = Validator::make($request->all(), User::$rules);
            
            // dd($validation);
            if (!$validation->fails()) {
                
                return $this->sendResponse(
                    Config::get('error.code.BAD_REQUEST'),
                    null,
                    $validation->getMessageBag()->all(),
                    Config::get('error.code.BAD_REQUEST')
                );
            } else {
                $authUser = Auth::attempt([
                    'email' => $request->email,
                    'password' => $request->password
                ]);

                //Get record if user has authenticated
                if ($authUser) {
                    $device = $request->header('client-id');
                    $user = User::where([
                        'email' => $request->email
                    ])->get([
                        'access_token',
                        'id',
                        'firstname',
                        'lastname',
                        'email',
                        'avatar',
                        'access_token',
                        'get_notification'
                    ])
                        ->first();

                    $user->access_token = uniqid();
                    $user->device_type = $device;
                    $user->save();
                    $user->get_notification = ($user->get_notification ? true : false);

                    unset($user->device_type);
                    $responseArray =  [
                        'status' => Config::get('constants.status.OK'),
                        'response' => $user,
                        'error' => null,
                        'custom_error_code' => null
                    ];
                } else {
                    $responseArray =  [
                        'status' => Config::get('error.code.NOT_FOUND'),
                        'response' => null,
                        'error' => [Config::get('error.message.USER_NOT_FOUND')],
                        'custom_error_code' => Config::get('error.code.NOT_FOUND')
                    ];
                }

                // end sad

                //Set the JSON response
                $status_code = $responseArray['status'];
                $response = $responseArray['response'];
                $error = $responseArray['error'];
                $custom_error_code = $responseArray['custom_error_code'];

                return $this->sendResponse($status_code, $response, $error, $custom_error_code);
            }
        } catch (\Exception $e) {
            return [
                'status' => Config::get('error.code.INTERNAL_SERVER_ERROR'),
                'response' => null,
                'error' => [$e->errorInfo[2]],
                'custom_error_code' => $e->errorInfo[0]
            ];
        }
    }
    public function signUp(Request $request)
    {
       
        try {
            $validator = Validator::make($request->all(), User::$rules);
            // dd($request->all());
            if (!$validator->fails()) {
                $users = new User();
                $users->firstname= $request->firstname;
                $users->lastname= $request->lastname;
                $users->email       = $request->email;
                $users->role_id       = 2;
                $users->password    = Hash::make($request->password);
                $users->access_token = uniqid();
                $users->device_type = $request->header('client-id');
                // $users->device_TYPE ='12344';
                // $users->settings_id ='12344';
            } else {

                return $this->sendResponse(
                    Config::get('error.code.INTERNAL_SERVER_ERROR'),
                    null,
                    $validator->messages()->all(),
                    Config::get('error.code.INTERNAL_SERVER_ERROR')
                );
            }

            if ($users->save()) {
                $users = User::find($users->id, [
                    // 'id', 'name', 'email', 'avatar', 'access_token', 'get_notification'
                    'id','email',
                ]);
                $users->get_notification = ($users->get_notification ? true : false);
                return $this->sendResponse(200, $users);
            }
        } catch (\Exception $e) {
            return $this->sendResponse(
                500,
                null,
                $e->getMessage()
            );
        }
    }

    public function home()
    {
        # code...
        $profile=Video::all();
        return $this->sendResponse(200, $profile);
    }
    
    public function video(Request $request)
    {
    
        # code...
        // dd($request->all());
        $videos=Video::where('id',$request->video_id)->get();
        return $this->sendResponse(200, $videos);
    }

    public function videocomments(Request $request)
    {
       
        # code...
        // dd($request->all());
        $comments=Video_Comments::where('video_id',$request->video_id)->get();
        return $this->sendResponse(200, $comments);
    }
    
    public function videomention(Request $request)
    {
       
        # code...
   
        $mention=Video_mention::where('video_id',$request->video_id)->get();
        return $this->sendResponse(200, $mention);
    }

    public function tag(Request $request)
    {
      
        # code...
        $tag=new Tag();
        $tag->tag=$request->tag;
        $tag->Save();
        $tags=Tag::all();
        return $this->sendResponse(200, $tags);
    }

    public function userprofile(Request $request)
    {
       
        # code...
        return $profile=User::with('uservideos')->where('id',$request->id)->get();
        // $profile=User::where('id',$request->id)->get();
        // $videos=Video::where('user_id',$request->id)->get();
        // return $this->sendResponse(200, $profile,$videos);
    }


    public function updateprofile(Request $request)
    {
        # code...
        
        $profile=User::
        where('id',$request->id)->get();
        $videos=Video::where('user_id',$request->id)->get();
        return $this->sendResponse(200, $profile,$videos);
    }

    public function user_update(Request $request)
    {
     
        $user=new User();
        $user=User::find($request->id);

 

        try {
            
            // $user = $request->attributes->get('user');
            if ($request->name) {
              
                // dd($user->name);
                $user->name = $request->name;
                 
            }
            if ($request->name) {
    
                $user->username = $request->username;
                 
            }

            if ($request->avatar) {
                $user->avatar = $request->avatar;
            }
            
            if ($request->bio) {
              
                $user->bio = $request->bio;
                 
            }
            if ($request->instagram) {
              
                $user->instagram = $request->instagram;
                 
            }

            if ($request->youtube) {
              
                $user->youtube = $request->youtube;
                 
            }
           
            $user->save();

            $response = new \stdClass();
            $response->access_token = $user->access_token;
            $response->id = $user->id;
            $response->name = $user->name;
            $response->username = $user->username;
            $response->email = $user->email;
            $response->avatar = $user->avatar;
            $response->bio = $user->bio;
            $response->instagram= $user->instagram;
            $response->youtube = $user->youtube;
            $response->get_notification = ($user->get_notification ? true : false);

            return $this->sendResponse(Config::get('constants.status.OK'), $response);
        } catch (\Exception $e) {
            return $this->sendResponse(
                Config::get('error.code.INTERNAL_SERVER_ERROR'),
                null,
                [$e->getMessage()],
                Config::get('error.code.INTERNAL_SERVER_ERROR')
            );
        }
    }
    
    public function mannage_account(Request $request)
    {
        # code...
        $data=User::where('id',$request->id)->get(['id','phone_number','email',]);
        return $this->sendResponse(200, $data);
    }

    public function payout(Request $request)
    {
        
        // $videos=Video::where('user_id',$request->id)->get();
        // return $this->sendResponse(200, $profile,$videos);
        
    }

    public function send_message(Request $request)
    {
        
        $message=new Massage();
        $message->name=$request->fullname;
        $message->email=$request->email;
        $message->message=$request->message;
        $message->Save();

        return $this->sendResponse(200, 'Message saved Successfully!');
        
    }
    //////////////////////////////////////////
    public function topusers(Request $request)
    {
        
       return $topusers=User::with('uservideos')->where('name',$request->name)->get(['id','name','username','avatar','followers']);
    }
   
    public function videotag(Request $request)
    {
      return  $video_tags=Video_tags::with('video')->get()->where('tag');
    }
    public function hashtag(Request $request)
    {
       
        # code...
        return $hashtags=Hashtag::with(['videohtag'])->where('name',$request->name)->orderBy('count','desc')->get();

    }
    public function userslist(Request $request)
    {
        # code...
        return $userslist=User::orderBy('followers','desc')->get();
    }

    public function videoslist(Request $request)
    {
        # code...
        return $videoslist=Video::with('video_owner')->orderBy('total_like','desc')->get(['id','user_id','detail','total_like']);
    }

    public function audiolist(Request $request)
    {
        # code...
        return $audioslist=Audio::with('audio_owner')->get(['id','user_id','url','total_like','imag']);
    }
    
    public function likelist(Request $request)
    {
       
        # code...
        // with(['user','video'])->
    //    return $likelist=Comment_like::where('video_like_id',$request->id)->get(['id','video_like_id']);
    // 'user',
          return $like_list=Comment_like::where('lid',$request->id)->with(['user','video'])->get();
    }

    public function comment_list(Request $request)
    {
        # code...
        return $comments_list=Comment_like::where('comment_id',$request->id)->with(['user','video'])->get();
    }

    public function mylikelist(Request $request)
    {
        # code...
       return $likelist=Comment_like::with('likelist',$request->id)->get();
    }

    public function mentions_list(Request $request)
    {
        return $mention_list=Video_mention::with(['mention_user','mention_video'])->where('user_id',$request->user_id)->get();
    }
    public function followers(Request $request)
    {
        # code...
        return $followerlist=User_followed::with('followed')->where('user_id',$request->user_id)->get(['id','user_id','followed_id']);
    }

    public function myfollowers(Request $request)
    {
        # code...
        return $followerlist=User_followed::with('myfollowers')->   where('followed_id',$request->user_id)->get(['id','user_id','followed_id']);
    }

    public function recommended_users(Request $request)
    {
        return $recommended_users=User::all();
    }
    

}
 