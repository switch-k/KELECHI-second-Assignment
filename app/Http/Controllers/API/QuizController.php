<?php

namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Option;
use Validator;

class QuizController extends BaseController
{
    public function index(){
        $quizzes = Quiz::all();
        return response()->json(['data' => $quizzes]);


    }
    public function update(Request $request, Quiz $quiz ){
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'title' => 'required',
            'question' => 'required',
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $quiz->title = $input['title'];
        $quiz->question = $input['question'];
        
        $quiz->save();
   
        return response()->json(['data' => $quiz]);

    }
    public function store(Request $request){
        
            $input = $request->all();
       
            $validator = Validator::make($input, [
                'title' => 'required',
                'question' => 'required',
                
            ]);
       
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }
       
            $quizzes = Quiz::create($input);
       
            return response()->json(['data' => $quizzes]);
        }

    
    public function show($id){
        
        {
            $quiz = Quiz::find($id);
           /* foreach ($options as $option) {
                return 
            }*/
    
            if (is_null($quiz)) {
                return $this->sendError('question   not found.');
            }
    
            return response()->json(['data' => $quiz]);
        }
    

    }

    public function option(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
            'option' => 'required|string',
            'c_option' => 'required|string',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $option = new Option([
           
            'option' => $request->get('option'),
            'c_option' => $request->get('c_option'),
            'user_id' => $request->get('user_id'),
            'quiz_id' => $request->get('quiz_id')
        ]);
            $option->save();
            return response ('Option was added successfuly');


        /* $data= new option;
        $data->user_id=$request->admin()->id;
        $data->quiz_id=$id;
        $data->Option=$request->option;
        $data->save();
        return response ('Checkout was added successfuly'); */



       

       /* foreach ($quiz->options as $option) {
            Option::create([
                'quiz_id'=>$quiz['id'],
                'option'=

            ]);
            
        }*/

        /*if ($someCondition) {
            $quizs->load('title', 'question');
        } */
        
    }

  


    /*public function checkout(Request $request)  {
        $input = $request->all();

 
    
        $checkout = checkOut::create([
            'total' => $request->total,
            'user_id' => auth()->id()
        ]);

        $cartItems = $request->cartItems;
        for ($i = 0; $i < count($cartItems); $i++) {
            $item = $cartItems[$i];
            Cart::create([
                'checkout_id' => $checkout['id'],
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'sub_total' => $item['sub_total']
            ]);
        }

        return response('Checkout was added successfuly');
    } */
}