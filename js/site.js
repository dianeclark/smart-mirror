function signin_button_callback(req) {
  if (req.error ===  "immediate_failed") {
    return;
  }

  var got_calendar_data = function(calendar_data) {
    console.log('got calendar data', calendar_data)
  };

  console.log(req.code)

  var data = {auth_code: req.code};

  console.log('sending auth code:', data)

  superagent.post('connect.php').type('form')
            .send(data)
            .end(got_calendar_data);

}