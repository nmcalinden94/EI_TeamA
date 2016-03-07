function validateForm() {
            var a = document.getElementById("accountInput").value;
            var p = document.getElementById("passwordInput").value;
            

            if ((a == a) && (p == p)) {
                return true;
            }
            else {
                if (a == "" || a == null) {
                    accountErrorText = "Please enter a valid account number";
                    document.getElementById("accountError").innerHTML = accountErrorText;
                    document.getElementById("comboError").innerHTML = "";
                }

                else if (a != "" || a != null) {
                    if (a.length<6) {
                        document.getElementById("accountError").innerHTML = "Account Number needs to be a minimum of 6 digits";
                    }
                    else {
                        document.getElementById("accountError").innerHTML = "";
                    }
                }

                if (p == "" || p == null) {
                    passwordErrorText = "Please enter a valid password";
                    document.getElementById("passwordError").innerHTML = passwordErrorText;
                    document.getElementById("comboError").innerHTML = "";
                }

                else if (p != "" || p != null) {
                    document.getElementById("passwordError").innerHTML = "";
                }

                if (a != "" && p != "") {
                    document.getElementById("comboError").innerHTML = "The account number or password you entered has not been found. Please enter them again.";
                }
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