// In your.env file  
PASSWORD_SECRET=my_secret_password  
  
// In your UpdateUser.php file  
use Illuminate\Support\Facades\Hash;  
  
//...  
  
'password' => 'equired|confirmed|min:8',  
'password_confirmation' => 'equired|min:8',  
  
//...  
  
public function rules()  
{  
   return [  
      'password' => 'equired|confirmed|min:8',  
      'password_confirmation' => 'equired|min:8',  
   ];  
}  
  
public function update(Request $request)  
{  
   $user = Auth::user();  
   $password = $request->input('password');  
  
   if (Hash::check($password, $user->password)) {  
      // Password is valid, update the user  
      $user->password = Hash::make($password);  
      $user->save();  
   } else {  
      // Password is invalid, return an error  
      return response()->json(['error' => 'Invalid password'], 401);  
   }  
}
