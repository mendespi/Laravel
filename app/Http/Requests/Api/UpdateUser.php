<?php  
  
namespace App\Http\Requests\Api;  
  
use Illuminate\Foundation\Http\FormRequest;  
use Illuminate\Support\Facades\Hash;  
  
class UpdateUser extends FormRequest  
{  
   /**  
    * Get data to be validated from the request.  
    *  
    * @return array  
    */  
   protected function validationData()  
   {  
      return $this->get('user')?: [];  
   }  
  
   /**  
    * Get the validation rules that apply to the request.  
    *  
    * @return array  
    */  
   public function rules()  
   {  
      return [  
        'username' => 'ometimes|max:50|alpha_num|unique:users,username,'. $this->user()->id,  
        'email' => 'ometimes|email|max:255|unique:users,email,'. $this->user()->id,  
        'password' => 'ometimes|min:6|confirmed',  
        'password_confirmation' => 'ometimes|min:6|required_with:password',  
        'bio' => 'ometimes|nullable|max:255',  
        'image' => 'ometimes|nullable|url',  
      ];  
   }  
  
   /**  
    * Configure the validator instance.  
    *  
    * @param  \Illuminate\Validation\Validator  $validator  
    * @return void  
    */  
   public function withValidator($validator)  
   {  
      $validator->after(function ($validator) {  
        if ($this->filled('password')) {  
           if (!Hash::check($this->input('password'), $this->user()->password)) {  
              $validator->errors()->add('password', 'Current password is incorrect');  
           }  
        }  
      });  
   }  
}
