
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>login</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
<style>
  
@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900');
body{
	font-family: 'Poppins', sans-serif;
	font-weight: 300;
	line-height: 1.7;
	color: #CCE4F4;
	background-color: #fff;
}
a:hover {
	text-decoration: none;
}
.link {
  color: #CCE4F4;
}
.link:hover {
  color: #c4c3ca;
}
p {
  font-weight: 500;
  font-size: 14px;
}
h4 {
  font-weight: 600;
}
h6 span{
  padding: 0 20px;
  font-weight: 700;
}
.section{
  position: relative;
  width: 100%;
  display: block;
}
.full-height{
  min-height: 100vh;
}
[type="checkbox"]:checked,
[type="checkbox"]:not(:checked){
display: none;
}
.checkbox:checked + label,
.checkbox:not(:checked) + label{
  position: relative;
  display: block;
  text-align: center;
  width: 60px;
  height: 16px;
  border-radius: 8px;
  padding: 0;
  margin: 10px auto;
  cursor: pointer;
  background-color: #85a1b4;
}
.checkbox:checked + label:before,
.checkbox:not(:checked) + label:before{
  position: absolute;
  display: block;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  color: #CCE4F4;
  background-color: #fff;
  font-family: 'unicons';
  content: '\eb4f';
  z-index: 20;
  top: -10px;
  left: -10px;
  line-height: 36px;
  text-align: center;
  font-size: 24px;
  transition: all 0.5s ease;
}
.checkbox:checked + label:before {
  transform: translateX(44px) rotate(-270deg);
}
.card-3d-wrap {
  position: relative;
  width: 440px;
  max-width: 100%;
  height: 400px;
  -webkit-transform-style: preserve-3d;
  transform-style: preserve-3d;
  perspective: 800px;
  margin-top: 60px;
}
.card-3d-wrapper {
  width: 100%;
  height: 100%;
  position:absolute;
  -webkit-transform-style: preserve-3d;
  transform-style: preserve-3d;
  transition: all 600ms ease-out; 
}
.card-front, .card-back {
  width: 100%;
  height: 100%;
  background-color: #ffffff;
  position: absolute;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  border-radius: 6px;
  transform-style: preserve-3d;
  padding: 250px 150px;
}
.card-back {
  transform: rotateY(180deg);
}
.checkbox:checked ~ .card-3d-wrap .card-3d-wrapper {
  transform: rotateY(180deg);
}
.center-wrap{
  position: absolute;
  width: 100%;
  padding: 0 35px;
  top: 50%;
  left: 0;
  transform: translate3d(0, -50%, 35px) perspective(100px);
  z-index: 20;
  display: block;
}
.form-group{ 
  position: relative;
  display: block;
    margin: 0;
    padding: 0;
}
.form-style {
  padding: 13px 20px;
  padding-left: 55px;
  height: 48px;
  width: 100%;
  font-weight: 500;
  border-radius: 4px;
  font-size: 14px;
  line-height: 22px;
  letter-spacing: 0.5px;
  outline: none;
  color: #000000;
  background-color: #fff;
  border: none;
  -webkit-transition: all 200ms linear;
  transition: all 200ms linear;
  box-shadow: 0 4px 8px 0 rgba(21,21,21,.2);
}
.form-style:focus,
.form-style:active {
  border: none;
  outline: none;
  box-shadow: 0 4px 8px 0 rgba(21,21,21,.2);
}
.input-icon {
  position: absolute;
  top: 0;
  left: 18px;
  height: 48px;
  font-size: 24px;
  line-height: 48px;
  text-align: left;
  -webkit-transition: all 200ms linear;
   transition: all 200ms linear;
}
.btn{  
  border-radius: 4px;
  height: 44px;
  font-size: 13px;
  font-weight: 600;
  text-transform: uppercase;
  -webkit-transition : all 200ms linear;
  transition: all 200ms linear;
  padding: 0 30px;
  letter-spacing: 1px;
  display: -webkit-inline-flex;
  display: -ms-inline-flexbox;
  display: inline-flex;
  align-items: center;
  background-color: #CCE4F4;
  color: #fff;
}
.btn:hover{  
  background-color: #fff;
  color: #CCE4F4;
  box-shadow: 0 8px 24px 0 rgba(16,39,112,.2);
}

.vectors {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%; /* Adjust the width as needed */
    z-index: -2;
}

.vectors2 {
    position: fixed;
    bottom: 0;
    right: 0;
    width: 100%; /* Adjust the width as needed */
    z-index: -2;
}
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900');
body{
	font-family: 'Poppins', sans-serif;
	font-weight: 300;
	line-height: 1.7;
	color: #CCE4F4;
	background-color: #fff;
}
a:hover {
	text-decoration: none;
}
.link {
  color: #CCE4F4;
}
.link:hover {
  color: #c4c3ca;
}
p {
  font-weight: 500;
  font-size: 14px;
}
h4 {
  font-weight: 600;
}
h6 span{
  padding: 0 20px;
  font-weight: 700;
}
.section{
  position: relative;
  width: 100%;
  display: block;
}
.full-height{
  min-height: 100vh;
}
[type="checkbox"]:checked,
[type="checkbox"]:not(:checked){
display: none;
}
.checkbox:checked + label,
.checkbox:not(:checked) + label{
  position: relative;
  display: block;
  text-align: center;
  width: 60px;
  height: 16px;
  border-radius: 8px;
  padding: 0;
  margin: 10px auto;
  cursor: pointer;
  background-color: #85a1b4;
}
.checkbox:checked + label:before,
.checkbox:not(:checked) + label:before{
  position: absolute;
  display: block;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  color: #CCE4F4;
  background-color: #fff;
  font-family: 'unicons';
  content: '\eb4f';
  z-index: 20;
  top: -10px;
  left: -10px;
  line-height: 36px;
  text-align: center;
  font-size: 24px;
  transition: all 0.5s ease;
}
.checkbox:checked + label:before {
  transform: translateX(44px) rotate(-270deg);
}
.card-3d-wrap {
  position: relative;
  width: 440px;
  max-width: 100%;
  height: 400px;
  -webkit-transform-style: preserve-3d;
  transform-style: preserve-3d;
  perspective: 800px;
  margin-top: 60px;
}
.card-3d-wrapper {
  width: 100%;
  height: 100%;
  position:absolute;
  -webkit-transform-style: preserve-3d;
  transform-style: preserve-3d;
  transition: all 600ms ease-out; 
}
.card-back {
  transform: rotateY(180deg);
}
.checkbox:checked ~ .card-3d-wrap .card-3d-wrapper {
  transform: rotateY(180deg);
}
.center-wrap{
  position: absolute;
  width: 100%;
  padding: 0 35px;
  top: 50%;
  left: 0;
  transform: translate3d(0, -50%, 35px) perspective(100px);
  z-index: 20;
  display: block;
}
.form-radio {
  margin-right: 10px;
  cursor: pointer;
}

.gender-style label {
  margin-right: 20px;
  font-size: 14px;
  color: #000; /* Adjust if necessary */
  cursor: pointer;
}

/* Styling for custom radio buttons */
.form-radio + label:before {
  content: '';
  display: inline-block;
  vertical-align: middle;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  margin-right: 10px;
  background-color: #f0f0f0;
  border: 2px solid #CCE4F4;
  cursor: pointer;
}

.form-radio:checked + label:before {
  background-color: #CCE4F4;
}


.form-group{ 
  position: relative;
  display: block;
    margin: 0;
    padding: 0;
}
.form-style {
  padding: 13px 20px;
  padding-left: 55px;
  height: 48px;
  width: 100%;
  font-weight: 500;
  border-radius: 4px;
  font-size: 14px;
  line-height: 22px;
  letter-spacing: 0.5px;
  outline: none;
  color: #000000;
  background-color: #fff;
  border: none;
  -webkit-transition: all 200ms linear;
  transition: all 200ms linear;
  box-shadow: 0 4px 8px 0 rgba(21,21,21,.2);
}
.form-style:focus,
.form-style:active {
  border: none;
  outline: none;
  box-shadow: 0 4px 8px 0 rgba(21,21,21,.2);
}
.input-icon {
  position: absolute;
  top: 0;
  left: 18px;
  height: 48px;
  font-size: 24px;
  line-height: 48px;
  text-align: left;
  -webkit-transition: all 200ms linear;
   transition: all 200ms linear;
}
.btn{  
  border-radius: 4px;
  height: 44px;
  font-size: 13px;
  font-weight: 600;
  text-transform: uppercase;
  -webkit-transition : all 200ms linear;
  transition: all 200ms linear;
  padding: 0 30px;
  letter-spacing: 1px;
  display: -webkit-inline-flex;
  display: -ms-inline-flexbox;
  display: inline-flex;
  align-items: center;
  background-color: #CCE4F4;
  color: #fff;
}
.btn:hover{  
  background-color: #fff;
  color: #CCE4F4;
  box-shadow: 0 8px 24px 0 rgba(16,39,112,.2);
}

.vectors {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%; /* Adjust the width as needed */
    z-index: -2;
}

.vectors2 {
    position: fixed;
    bottom: 0;
    right: 0;
    width: 100%; /* Adjust the width as needed */
    z-index: -2;
}
</style>
</head>
<body>
  <img class="vectors" src="blu vec.png">
  <img class="vectors2" src="pink vec.png">

  <div class="section">
    <div class="container">
      <div class="row full-height justify-content-center">
        <div class="col-12 text-center align-self-center py-5">
          <div class="section pb-5 pt-5 pt-sm-2 text-center">
            <h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>
            <input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
            <label for="reg-log"></label>
            <div class="card-3d-wrap mx-auto">
              <div class="card-3d-wrapper">
                <div class="card-front">
                  <div class="center-wrap">
                    <div class="section text-center">
                      <h4 class="mb-4 pb-3">Log In</h4>
                      <form action="login.php" method="post">
                        <div class="form-group">
                          <input type="email" name="email" class="form-style" placeholder="Email" required>
                          <i class="input-icon uil uil-at"></i>
                        </div>  
                        <div class="form-group mt-2">
                          <input type="password" name="password" class="form-style" placeholder="Password" required minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>>
                          <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        <button type="submit" class="btn mt-4">Login</button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="card-back">
                  <div class="center-wrap">
                    <div class="section text-center">
                      <h4 class="mb-3 pb-3">Sign Up</h4>
                      <form action="register.php" method="post">
  <!-- Full Name -->
  <div class="form-group">
    <input type="text" name="full_name" class="form-style" placeholder="Full Name" required>
    <i class="input-icon uil uil-user"></i>
  </div>  
  <!-- SSN -->
  <div class="form-group">
    <input type="text" name="patients_file" class="form-style" placeholder="SSN" required>
  </div>  
   <!-- Date of Birth -->
   <div class="form-group">
    <input type="date" id="dob" name="dob" class="form-style" placeholder="Date of Birth" required>
  </div>

  <!-- Blood Type -->
<div class="form-group">
  <select id="blood_type" name="blood_type" class="form-style" required>
    <option value="">Select Blood Type</option>
    <option value="A+">A+</option>
    <option value="A-">A-</option>
    <option value="B+">B+</option>
    <option value="B-">B-</option>
    <option value="AB+">AB+</option>
    <option value="AB-">AB-</option>
    <option value="O+">O+</option>
    <option value="O-">O-</option>
  </select>
</div>

  <!-- Email -->
  <div class="form-group">
    <input type="email" name="email" class="form-style" placeholder="Email" required>
    <i class="input-icon uil uil-at"></i>
  </div>

  <!-- Password -->
  <div class="form-group">
    <input type="password" name="password" class="form-style" placeholder="Password" required minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>>
    <i class="input-icon uil uil-lock-alt"></i>
  </div>

  <!-- Gender -->
  <div class="form-group gender-style">
    <input type="radio" id="female" name="gender" value="Female" class="form-radio">
    <label for="female">Female</label>
    <input type="radio" id="male" name="gender" value="Male" class="form-radio">
    <label for="male">Male</label>
  </div>
  <button type="submit" class="btn mt-4">Register</button>
</form>


                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <img class="vectors" src="vectors2.jpg">
  <img class="vectors2" src="vectors.jpg">
  <script src="login.js"></script>
</body>
</html>
