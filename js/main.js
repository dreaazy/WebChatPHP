/* searching for new users of groups */
let form = document.getElementById("searchForm");

form.addEventListener("submit", (e) => {
  document.getElementById("Closed-tab").click();

  e.preventDefault();
  let toSearch = document.getElementById("searchValue").value;

  caricaJsonPost(toSearch);
});

//LOAD JSON POST

function caricaJsonPost(text) {
  const xhttp = new XMLHttpRequest();

  xhttp.open("POST", "inc/search.inc.php", true); // method GET o POST, url, async

  xhttp.setRequestHeader("Accept", "application/json;charset=UTF-8");

  // taking what the user is searching
  bodyreq = `{"SearchText": "${text}"}`;

  //request sent
  xhttp.send(bodyreq);

  xhttp.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      rsp = this.responseText;

      var obj = JSON.parse(rsp);

      document.getElementById("chat-list").innerHTML = "";

      console.log(obj);

      obj.forEach(function (user) {
        /*         // Example date string
        const dateString = user.UltimaVoltaOnline;

        // Parse the date string into a Date object
        const date = new Date(dateString);

        // Extract hours and minutes
        const hours = date.getHours();
        const minutes = date.getMinutes();

        // Format hours and minutes to ensure two digits
        const formattedHours = hours.toString().padStart(2, "0");
        const formattedMinutes = minutes.toString().padStart(2, "0");

        // Combine hours and minutes
        const timeString = `${formattedHours}:${formattedMinutes}`;

        <p class="bottom-0 h8 position-absolute border border-2 ">${timeString}</p> */

        document.getElementById("chat-list").innerHTML += `
          

        <a href="profile.php?user=${user.username}" class="d-flex align-items-center">
          <div class="flex-shrink-0">
              <img class="img-fluid rounded-circle" src="${user.img}" alt="user img" style="width: 50px; height: 50px;">
              <span class="active"></span>
          </div>
          <div class="flex-grow-1 ms-3">
              <h3>${user.username}</h3>
              <p>${user.Nome} ${user.Cognome}</p>
          </div>
        </a>
    
          
        `;
      });
    }
  };
}

//LOAD CHATTING USE

function CaricaChattingUser() {
  const xhttp = new XMLHttpRequest();
  xhttp.open("POST", "inc/loadChattingUser.inc.php", true);
  xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xhttp.setRequestHeader("Accept", "application/json");

  xhttp.send(); // No body is sent

  xhttp.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      const rsp = JSON.parse(this.responseText);

      // Clear previous content
      const userProfileElement = document.getElementById("head-chatting-user");

      userProfileElement.innerHTML = "";

      if (rsp.error) {
        // Display the error message
        userProfileElement.innerHTML = `<p>Error: ${rsp.error}</p>`;
      } else if (rsp.success) {
        // Extract user data from success response
        const userData = rsp.success;
        console.log(userData);
        // Render user data
        userProfileElement.innerHTML = `
                              <div class="row">
                                  <!-- PROFILE INFORMATION OF CHATBOX -->
                                  <div class="col-8">
                                      <div class="d-flex align-items-center">
                                          <span class="chat-icon"><img class="img-fluid" src="https://mehedihtml.com/chatbox/assets/img/arroleftt.svg" alt="image title"></span>
                                          <div class="flex-shrink-0">
                                              <img class="img-fluid" src="${userData.img}" alt="user img" style="width: 50px; height: 50px;">
                                          </div>
                                          <div class="flex-grow-1 ms-3">
                                              <h3>${userData.username}</h3>
                                              <p>front end developer</p>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- PROFILE INFORMATION OF CHATBOX -->

                                  <div class="col-4">
                                      <ul class="moreoption">
                                          <li class="navbar nav-item dropdown">
                                              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                              <ul class="dropdown-menu">
                                                  <li><a class="dropdown-item" href="#">Action</a></li>
                                                  <li><a class="dropdown-item" href="#">Another action</a>
                                                  </li>
                                                  <li>
                                                      <hr class="dropdown-divider">
                                                  </li>
                                                  <li><a class="dropdown-item" href="#">Something else
                                                          here</a></li>
                                              </ul>
                                          </li>
                                      </ul>
                                  </div>
                              </div>
      `;
      }
    } else if (this.readyState === 4) {
      // Handle non-200 status codes
      document.getElementById(
        "user-profile"
      ).innerHTML = `<p>Unable to fetch data. Status code: ${this.status}</p>`;
    }
  };
}

//SEND MESSAGE

function SendMessage() {
  let Message = document.getElementById("input-text-message").value;

  const xhttp = new XMLHttpRequest();

  xhttp.open("POST", "inc/messageAConversation.inc.php", true);
  xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

  // Taking what the user is searching
  bodyreq = `{"Message":"${Message}"}`;

  // Request sent
  xhttp.send(bodyreq);

  xhttp.onreadystatechange = function () {
    if (this.readyState === 4) {
      if (this.status === 200) {
        console.log(this.responseText); // Log the response text
        rsp = JSON.parse(this.responseText);
        console.log(rsp);
        // Check if the response indicates success
        if (rsp.success) {
          // Redirect the user to index.php
          /* window.location.href = 'index.php'; */
          // Specify the path to index.php
        }
      } else {
        // Handle errors or other responses here
      }
    }
  };





  /* AGGIORNO */
  let messagesBody = document.getElementById("msg-body-list");
  messagesBody.innerHTML = "";
  FetchMessages();
}

/* FETCH MESSAGES */

function FetchMessages() {
  const xhttp = new XMLHttpRequest();

  xhttp.open("POST", "inc/fetchMessages.inc.php", true);
  xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  // Request sent
  xhttp.send();
  
  xhttp.onreadystatechange = function () {
    if (this.readyState === 4) {
      
      if (this.status === 200) {
        rsp = JSON.parse(this.responseText);
        console.log("rsp");
        /* taking the ul where I'm going to append all the messages */
        let messagesBody = document.getElementById("msg-body-list");

        

        // Check if the response indicates success
        if (rsp.success) {
          let MessagesData = rsp.success;

          let IDSender = rsp.IDSender;

          console.log(IDSender);
          console.log(MessagesData);

          MessagesData.forEach(function (element) {
            // Create a new li element
            var li = document.createElement("li");

            // Create new elements for the message
            var p = document.createElement("p");
            var span = document.createElement("span");

            if (element.IDUtente == IDSender) {
              li.className = "sender";
            } else {
              li.className = "repaly";
            }

            // Set text content of the circle (you can customize this)
            p.textContent = element.Contenuto;
            span.textContent = element.DataCreazione;

            span.className = "time";

            // Append circle to li
            li.appendChild(p);
            li.appendChild(span);

            // Append li to ul
            messagesBody.appendChild(li);
          });
        }
      } else {
        // Handle errors or other responses here
      }
    }
  };
}

/* load user profile */

function LoadUserProfile() {
  const xhttp = new XMLHttpRequest();
  xhttp.open("POST", "inc/loadUserProfile.inc.php", true);
  xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xhttp.setRequestHeader("Accept", "application/json");

  xhttp.send(); // No body is sent

  xhttp.onreadystatechange = function () {
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

/* PROFILE.PHP */

