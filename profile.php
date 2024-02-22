<?php

if (!isset($_GET["user"])) {
    header("Location: index.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/chat-style.css">

    <title>Document</title>
</head>

<body>
    <section class="message-area">

        <div class="container">

            <?php include __DIR__ . '/tmpl/navbar.php'; ?>
            <div id="user-profile"></div>

        </div>
    </section>

    <script>
        // This function now does not need a parameter
        function caricaJsonPost() {
            // Extract 'text' parameter from the URL
            const urlParams = new URLSearchParams(window.location.search);
            const text = urlParams.get("user"); // 'text' is the name of the query parameter

            if (!text) {
                console.error("Text parameter is missing in the URL");
                return;
            }

            const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "inc/search.inc.php?t=exact", true); // method GET o POST, url, async
            xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8"); // Set correct content type for JSON
            xhttp.setRequestHeader("Accept", "application/json");

            // Taking what the user is searching
            const bodyreq = JSON.stringify({
                SearchText: text,
            });

            // Request sent
            xhttp.send(bodyreq);

            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    const rsp = this.responseText;

                    // Clear previous content
                    const userProfileElement = document.getElementById("user-profile");
                    userProfileElement.innerHTML = "";

                    const obj = JSON.parse(rsp); //parse

                    if (obj.length == 0) {
                        userProfileElement.innerHTML = `<p>The user doesn't exist</p>`;
                    } else if (obj.error) {
                        // Display the error message
                        userProfileElement.innerHTML = `<p>Error: ${obj.error}</p>`;
                    } else {
                        // Iterate through the user data and display it
                        obj.forEach(function(user) {
                            userProfileElement.innerHTML += `
                    <div class="container py-5">
                        <div class="row">
                            <div class="col-md-4 mx-auto">
                                <!-- Profile Image -->
                                <div class="text-center mb-4">
                                    <img src="${user.img}" class="rounded-circle img-fluid" alt="Profile Image" style="width: 150px; height: 150px;">
                                </div>
                                
                                <!-- User Info -->
                                <div class="text-center mb-3">
                                    <h2 id="user-name" class="mb-2">${user.Nome} ${user.Cognome}</h2>
                                    <h3 id="user-username" class="text-muted">${user.username}</h3>
                                </div>
                                
                                <!-- Contact Info -->
                                <div class="mb-3">
                                    <p>Email: <span id="user-email" class="text-secondary">${user.Email}</span></p>
                                    <p>Cell: <span id="user-cell" class="text-secondary">${user.Cell}</span></p>
                                    <p>Last Online: <span id="user-last-online" class="text-secondary">${user.UltimaVoltaOnline}</span></p>
                                </div>
                                
                                <!-- Action Button -->
                                <div class="d-flex flex-column align-items-center">
                                    
                                    <button onClick="OpenConversation(${user.ID})" class="btn btn-primary my-2">Message</button>
                                    
                                    <div class="d-flex align-items-center">
                                        <button onClick="DisplayInputImg()" class="btn btn-primary my-2">Change Img</button>
                                        <input class="form-control d-none m-3" type="text" name="imgSource" id="imgSource" placeholder="link of the image">
                                        <button onClick="ChangeImg(${user.ID})" class="btn btn-primary my-2 d-none" id="btImg">Submit</button>
                                    </div>

                                    <!-- New set of input and button -->
                                    <div class="d-flex align-items-center">
                                        <button onClick="DisplayInputCell()" class="btn btn-primary my-2">Change Cell</button>
                                        <input class="form-control d-none m-3" type="text" name="somethingSource" id="cellSource" placeholder="mobile phone">
                                        <button onClick="ChangeCell(${user.ID})" class="btn btn-primary my-2 d-none" id="btCell">Submit</button>
                                    </div>

                                    <!-- Another set of input and button -->
                                    <div class="d-flex align-items-center">
                                        <button onClick="DisplayInputEmail()" class="btn btn-primary my-2">Change Email</button>
                                        <input class="form-control d-none m-3" type="text" name="anotherSource" id="emailSource" placeholder="your email">
                                        <button onClick="ChangeEmail(${user.ID})" class="btn btn-primary my-2 d-none" id="btEmail">Submit</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

            `;
                        });
                    }
                } else if (this.readyState === 4) {
                    // Handle non-200 status codes
                    document.getElementById(
                        "user-profile"
                    ).innerHTML = `<p>Unable to fetch data. Status code: ${this.status}</p>`;
                }
            };
        }

        function DisplayInputImg() {
            let imgInput = document.getElementById("imgSource");
            let btInput = document.getElementById("btImg");

            imgInput.classList.remove("d-none");
            btInput.classList.remove("d-none");
            /* imgInput.classList.add("your-new-bootstrap-class"); */
        }

        function DisplayInputCell() {
            let cellInput = document.getElementById("cellSource");
            let btInput = document.getElementById("btCell");

            cellInput.classList.remove("d-none");
            btInput.classList.remove("d-none");
        }

        function DisplayInputEmail() {
            let emailInput = document.getElementById("emailSource");
            let btInput = document.getElementById("btEmail");

            emailInput.classList.remove("d-none");
            btInput.classList.remove("d-none");
        }

        function ChangeImg(id) {
            const xhttp = new XMLHttpRequest();

            let srcimg = document.getElementById("imgSource").value;

            xhttp.open("POST", "inc/updateUserAttribute.inc.php", true);
            xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

            // Taking what the user is searching
            bodyreq = `{"UserId": "${id}", "Attribute": "img" ,"value":"${srcimg}"}`;

            // Request sent
            xhttp.send(bodyreq);

            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    rsp = this.responseText;
                    console.log(rsp);
                }
            };
        }

        function ChangeCell(id) {
            const xhttp = new XMLHttpRequest();

            let cell = document.getElementById("cellSource").value;

            xhttp.open("POST", "inc/updateUserAttribute.inc.php", true);
            xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

            // Taking what the user is searching
            bodyreq = `{"UserId": "${id}", "Attribute": "Cell" ,"value":"${cell}"}`;

            // Request sent
            xhttp.send(bodyreq);

            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    rsp = this.responseText;
                    console.log(rsp);
                }
            };
        }

        function ChangeEmail(id) {
            const xhttp = new XMLHttpRequest();

            let cell = document.getElementById("emailSource").value;

            xhttp.open("POST", "inc/updateUserAttribute.inc.php", true);
            xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

            // Taking what the user is searching
            bodyreq = `{"UserId": "${id}", "Attribute": "Email" ,"value":"${cell}"}`;

            // Request sent
            xhttp.send(bodyreq);

            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    rsp = this.responseText;
                    console.log(rsp);
                }
            };
        }

        function OpenConversation(id) {
            const xhttp = new XMLHttpRequest();

            xhttp.open("POST", "inc/joinConversation.inc.php", true);
            xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

            // Taking what the user is searching
            bodyreq = `{"IDDestinatario": "${id}"}`;

            // Request sent
            xhttp.send(bodyreq);

            xhttp.onreadystatechange = function() {
                if (this.readyState === 4) {
                    if (this.status === 200) {
                        console.log(this.responseText); // Log the response text
                        rsp = JSON.parse(this.responseText);
                        console.log(rsp);
                        // Check if the response indicates success
                        if (rsp.success) {
                            // Redirect the user to index.php
                            window.location.href = "index.php"; // Specify the path to index.php
                        }
                    } else {
                        // Handle errors or other responses here
                    }
                }
            };
        }

        function LoadUserProfile() {
            const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "inc/loadUserProfile.inc.php", true);
            xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhttp.setRequestHeader("Accept", "application/json");

            xhttp.send(); // No body is sent

            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    const rsp = JSON.parse(this.responseText);

                    // Clear previous content
                    const userProfileElement = document.getElementById("profile-container");

                    userProfileElement.innerHTML = "";

                    if (rsp.error) {
                        // Display the error message
                        userProfileElement.innerHTML = `<p>Error: ${rsp.error}</p>`;
                    } else if (rsp.success) {
                        // Extract user data from success response
                        const userData = rsp.success;

                        // Render user data
                        const userProfileHTML = `
          <a href="profile.php?user=${userData.username}">
            <img src="${userData.img}" alt="${userData.username}" class="rounded-circle" style="width: 40px; height: 40px; margin-right: 8px;">
            <span class="navbar-text">${userData.username}</span>
          </a>
        `;

                        // Replace the content of userProfileElement with the generated HTML
                        userProfileElement.innerHTML = userProfileHTML;
                    } else {
                        // Handle unexpected response structure
                        userProfileElement.innerHTML = `<p>Unexpected response structure</p>`;
                    }
                } else if (this.readyState === 4) {
                    // Handle non-200 status codes
                    document.getElementById(
                        "profile-container"
                    ).innerHTML = `<p>Unable to fetch data. Status code: ${this.status}</p>`;
                }
            };
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            LoadUserProfile();
            caricaJsonPost();
        });
    </script>

</body>

</html>