var validator={
    init:function(){
        $j("#valid_login").validate({
            rules:{
                user_name:"required",
                password:"required"
            },
            messages:{
                user_name:"Please Enter User Name",
                password:"Please Enter Password!"
            }
        });

        $j("#valid_user").validate({
            rules:{
                user_name:"required",
                first_name:"required",
                last_name:"required",
                password:"required",
                confirm_password:{
                    required:true,
                    equalTo:$j("#password")
                }
            },
            messages:{
                user_name:"Please Enter User Name",
                first_name:"Please Enter First Name",
                last_name:"Please Enter Last Name",
                password:"Please Enter Password",
                confirm_password:{
                    required:"Please Enter Confirm Password",
                    equalTo:"Confirm Password is not Matched"
                }
            }
        });
        
       $j("#valid_page").validate({
            rules: {
                page_name: "required",
                page_title: "required"
            },
            messages: {
                page_name: "Please Enter Page Name",
                page_title: "Please Enter Page Title"
            }
        });
        $j("#valid_feedback").validate({
            rules: {
                first_name: "required",
                last_name: "required",
                email: "required",
                comments: "required",
                feedback_reply: "required"
            },
            messages: {
                first_name: "Please Enter First Name",
                last_name: "Please Enter Last Name",
                email: "Please Enter Email",
                comments: "Please Enter Comments",
                feedback_reply: "Please Enter Reply Message"
            }
        });
        $j('#valid_tradecompany').validate({
             rules: {
                trading_code: "required"
            },
            messages: {
                trading_code: "Please Enter Trading Code!"
            }
        });
        
    }
}