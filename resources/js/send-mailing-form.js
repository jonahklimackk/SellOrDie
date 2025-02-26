


    <script>


      var limit = {{ App\Models\User::all()->count() }}



      function changeCredits()
      {
        credits = parseInt($('[name=credits]').val());
        console.log(credits);
        number_people_downline = parseInt($('#number_people_downline').text());
        bonus_credits = parseInt($('#bonus_credits').text());
        guar_send = number_people_downline + bonus_credits;

        total = credits + guar_send < limit ? credits + guar_send : limit;
        credits = total - guar_send;

        if (credits  < 0 ){
          credits = 0;
        }
        $('#credits_spent').text(credits);
        $('#total_recipients').text(total)
        $('#total_recipients2').text(total + ' recipients')
      }

      $('[name=credits]').keyup(changeCredits).keydown(changeCredits).change(changeCredits())



      $('#previous_mail').change(function() {
        if ($('#previous_mail option:selected').val() != -1) {
          mail_id = $('#previous_mail option:selected').attr('data-mail_id');
          $('.step2').addClass('wait');
          $('html').addClass('wait');
          $.get('/sendmail/previous/' + mail_id, function(data) {
            if (data === 'false') {

            } else {
              $('[name=subject]').val(data.subject)
              $('[name=url]').val(data.url)
              $('[name=message]').val(data.body);
            // editor.setData(data.body);
              // alert(data.body);
            }
            $('.step2').removeClass('wait');
            $('html').removeClass('wait');
          })
        }
      })

      $(document).ready(function() {
        changeCredits()


      });



      function includeHidden() {

        credits_spent = parseInt($('#credits_spent').text());
      // alert(credits_spent);
        number_people_downline = parseInt($('#number_people_downline').text());
        mailing_bonus_credits = parseInt($('#bonus_credits').text());
      // credits = parseInt($('[name=credits]').val());

        console.log(credits_spent);
        console.log(number_people_downline);
        console.log(mailing_bonus_credits);
        console.log(document.getElementById("subject").innerText);



        document.getElementById('myField').value = number_people_downline;
        document.getElementById('myField2').value = mailing_bonus_credits;
        document.getElementById('myField3').value = credits_spent;
       // document.getElementById('myField3').value = credits;
      }

      function ajaxCall() {
        $.ajax({

        // Our sample url to make request 
          url:
          '/sendmail/queue/',

          // Type of Request
          type: "POST",

        //the data
          data:{
            "credits_spent":credits_spent,
            "number_people_downline":number_people_downline,
            "mailing_bonus_credits":mailing_bonus_credits,
            "subject": document.getElementById("subject").innerText,
            "url": document.getElementById("url").innerText,
            "message":document.getElementById("message").innerText,
            "_token": '{{ csrf_token() }}'
          },
                // Function to call when to
                // request is ok 
          success: function (data) {
            let x = JSON.stringify(data);
          // console.log(x);
            console.log(data);
            document.getElementById("return_message").innerHTML = data;
          },
                // Error handling 
          error: function (error) {
            console.log(`Error ${error}`);
            alert(error.data);
          }
        });
      }


    </script>