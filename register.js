function validateForm() {
                var a = document.getElementById("accountInput").value;
                var m = document.getElementById("mprnInput").value;
                var p = document.getElementById("passwordInput").value;
                var cp = document.getElementById("confirmPasswordInput").value;
                var passwordNumberRe = /[0-9]/;
                var passwordLcRe = /[a-z]/;
                var passwordUcRe = /[A-Z]/;
                var accountValid, mrpnValid, passwordValid, cPasswordValid;

                    if (a == "" || a == null || a.length <6) {
                        accountErrorText = "Please enter an account number, with a minimum of 6 digits";
                        document.getElementById("accountError").innerHTML = accountErrorText;
                    }

                    else if (a != "" || a != null) {
                        document.getElementById("accountError").innerHTML = "";
                        accountValid = true;
                    }

                    if (m == "" || m == null || m.length !=11 ) {
                        mprnErrorText = "Please enter your 11 digit MPRN Number";
                        document.getElementById("mprnError").innerHTML = mprnErrorText;
                    }

                    else if (m != "" || m != null) {
                        document.getElementById("mprnError").innerHTML = "";
                        mrpnValid = true;
                    }

                    if (p == "" || p == null) {
                        passwordErrorText = "Please enter an password";
                        document.getElementById("passwordError").innerHTML = passwordErrorText;
                    }
                    
                    else if (p != "" || p != null) {
                        if (!passwordNumberRe.test(p)) {
                            document.getElementById("passwordError").innerHTML = "Password must contain at least 1 number";
                        }
                        else if (!passwordLcRe.test(p)) {
                            document.getElementById("passwordError").innerHTML = "Password must contain at least 1 lowercase letter";
                        }
                        else if (!passwordUcRe.test(p)) {
                            document.getElementById("passwordError").innerHTML = "Password must contain at least 1 uppercase letter";
                        }
                        else if (p.length<6) {
                            document.getElementById("passwordError").innerHTML = "Password must contain at least 6 digits";
                        }
                        else {
                            document.getElementById("passwordError").innerHTML = "";
                            passwordValid = true;
                        }
                    }


                   if (cp != "" || cp != null) {
                        if (cp != p) {
                            document.getElementById("confirmPasswordError").innerHTML = "Please make sure your passwords match";
                        }
                        else {
                            document.getElementById("confirmPasswordError").innerHTML = "";
                            cPasswordValid = true;
                        }
                   }

                    if (accountValid==true && mrpnValid == true && passwordValid == true  && cPasswordValid==true ) {
                        return true;
                    }
                    else {
                        return false;
                    }
                
            }

            function isNumber(evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    return false;
                }
                return true;
            };