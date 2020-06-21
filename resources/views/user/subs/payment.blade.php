@extends('layouts.user')
@section('css')
    <style>
        .StripeElement {
            box-sizing: border-box;

            height: 40px;

            padding: 10px 12px;

            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;

            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>
@stop

@section('user')
    <div class="row">
        <div class="col-12">
{{--            <form action="#" method="post" enctype="multipart/form-data">--}}
{{--            @csrf--}}
            <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Subscrib payment</h4>

                        <div class="row">
                            <div class="col-md-12">
                                <select name="plan" class="form-control" id="subscription-plan">
                                    @foreach($plan as $key=>$pla)
                                        <option value="{{$key}}">{{$pla}}</option>
                                    @endforeach
                                </select>
                                <input id="card-holder-name" class="form-control" placeholder="Card Holder" type="text">

                                <!-- Stripe Elements Placeholder -->
                                <div id="card-element"></div>

                                <button class="btn btn-success" id="card-button" data-secret="{{ $intent->client_secret }}">
                                    Process Payment
                                </button>
                            </div>


                        </div>
                        <div class="form-actions">
{{--                            <div class="card-body">--}}
{{--                                <button id="card-button" data-secret="{{ $intent->client_secret }}">--}}
{{--                                    Update Payment Method--}}
{{--                                </button>--}}

{{--                            </div>--}}
                        </div>
                    </div>

                </div>
{{--            </form>--}}
        </div>
    </div>
@stop
@section('js')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>

    <script>
       window.addEventListener('load',function () {
           const stripe = Stripe('pk_test_ceyoY7uA4tKyBOj065u9H4YN00Emw5XrJ1');

           const elements = stripe.elements();
           const cardElement = elements.create('card');

           cardElement.mount('#card-element');

           const cardHolderName = document.getElementById('card-holder-name');
           const cardButton = document.getElementById('card-button');
           const clientSecret = cardButton.dataset.secret;

           const plan = document.getElementById('subscription-plan').value;


           cardButton.addEventListener('click', async (e) => {
               const { setupIntent, error } = await stripe.handleCardSetup(
                   clientSecret, cardElement, {
                       payment_method_data: {
                           billing_details: { name: cardHolderName.value }
                       }
                   }
               );
               if (error) {
                   // Display "error.message" to the user...
               } else {
                   // The card has been verified successfully...
                   console.log('handling success', setupIntent.payment_method);
                   // axios.post('/subscribe',{
                   //     payment_method: setupIntent.payment_method,
                   //     plan : plan
                   // }).then((data)=>{
                   //     location.replace(data.data.success_url)
                   // });


                   $.ajax({
                       type : "POST",
                       url: "{{route('subs.pay.user.save')}}",
                       data : {
                           '_token' : "{{csrf_token()}}",
                           payment_method: setupIntent.payment_method,
                           plan : plan
                       },
                       success:function(data){
                           console.log(data)
                       }
                   });


               }
           });

       })
    </script>
@stop
