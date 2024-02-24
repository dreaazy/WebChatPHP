/* searching for new users of groups */
let form = document.getElementById("searchForm");

form.addEventListener("submit", (e) => {
  document.getElementById("Closed-tab").click();

  e.preventDefault();
  let toSearch = document.getElementById("searchValue").value;

  caricaJsonPost(toSearch);
});


/* do a fetch post with a callback */
function FetchPost(path, body, callback) {
  const xhttp = new XMLHttpRequest();

  xhttp.open("POST", path, true);
  xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

  xhttp.onreadystatechange = function () {
    if (this.readyState === 4) {
      if (this.status === 200) {
        const rsp = this.responseText;
        const obj = JSON.parse(rsp);
        callback(obj);
      } else {
        callback(null, new Error("Request failed"));
      }
    }
  };

  const bodyreq = JSON.stringify(body);

  xhttp.send(bodyreq);
}

//LOAD JSON POST

function LoadMyChats() {
  let body = { SearchText: text };

  FetchPost("inc/search.inc.php", body, function (data, error) {
    if (error) {
      console.error(error);
      return;
    }

    document.getElementById("my-chats").innerHTML = "";

    data.forEach(function (user) {
      document.getElementById("my-chats").innerHTML += `
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
  });
}



function caricaJsonPost(text) {
  let body = { SearchText: text };

  FetchPost("inc/search.inc.php", body, function (data, error) {
    if (error) {
      console.error(error);
      return;
    }

    document.getElementById("chat-list").innerHTML = "";

    data.forEach(function (user) {
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
  });
}

function CaricaChattingUser() {
  const path = "inc/loadChattingUser.inc.php";
  const body = {}; // No body required for this request

  // Callback function to handle the response
  const callback = function (response, error) {
    if (error) {
      // Handle error
      document.getElementById(
        "head-chatting-user"
      ).innerHTML = `<p>Error: ${error.message}</p>`;
    } else {
      // Clear previous content
      const userProfileElement = document.getElementById("head-chatting-user");
      userProfileElement.innerHTML = "";

      if (response.error) {
        // Display the error message
        /* userProfileElement.innerHTML = `<p>Error: ${response.error}</p>`; */
        console.log(response.error);
      } else if (response.success) {
        // Extract user data from success response
        const userData = response.success;

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
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        `;
      }
    }
  };

  // Make the POST request using FetchPost
  FetchPost(path, body, callback);
}

//SEND MESSAGE

function SendMessage() {
  // Get the message from the input field
  let message = document.getElementById("input-text-message").value;

  const path = "inc/messageAConversation.inc.php";
  const body = { Message: message }; // Construct the request body

  // Callback function to handle the response
  const callback = function (response, error) {
    if (error) {
      // Handle errors or other responses here
      console.error("Request failed:", error);
    } else {
      console.log(response); // Log the response text

      // Check if the response indicates success
      if (response.success) {
        // Redirect the user to index.php
        /* window.location.href = 'index.php'; */
        // Specify the path to index.php
      }
    }

    /* AGGIORNO */
    // Clear message body and fetch messages again
    let messagesBody = document.getElementById("msg-body-list");
    messagesBody.innerHTML = "";
    FetchMessages();
  };

  // Make the POST request using FetchPost
  FetchPost(path, body, callback);
}

/* FETCH MESSAGES */

function FetchMessagesInRange() {
  const path = "inc/testing.php";
  const body = {"date1":"2024-02-21","date2":"2025-12-01"}; // No body required for this request

  // Callback function to handle the response
  const callback = function (response, error) {
    if (error) {
      // Handle errors or other responses here
      console.error("Request failed:", error);
    } else {
      console.log(response); // Log the response text

      /* taking the ul where I'm going to append all the messages */
      let messagesBody = document.getElementById("msg-body-list");

      // Check if the response indicates success
      if (response.success) {
        let messagesData = response.success;
        let idSender = response.IDSender;

        console.log(idSender);
        console.log(messagesData);

        messagesData.forEach(function (element) {
          // Create a new li element
          var li = document.createElement("li");

          // Create new elements for the message
          var p = document.createElement("p");
          var span = document.createElement("span");

          if (element.IDUtente == idSender) {
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
      else {
        //if I have no one to chat with

        let bodyMessages = document.getElementById("body-of-messages");

        bodyMessages.innerHTML = "";

        bodyMessages.innerHTML = `
          <div class="d-flex justify-content-center align-items-center style="height:100%;width:100%;">
            <p>
              start chatting with someone
            </p>
          </div>
      `;

      }
    }
  };

  // Make the POST request using FetchPost
  FetchPost(path, body, callback);
}


function FetchMessages() {
  const path = "inc/fetchMessages.inc.php";
  const body = {}; // No body required for this request

  // Callback function to handle the response
  const callback = function (response, error) {
    if (error) {
      // Handle errors or other responses here
      console.error("Request failed:", error);
    } else {
      console.log(response); // Log the response text

      /* taking the ul where I'm going to append all the messages */
      let messagesBody = document.getElementById("msg-body-list");

      // Check if the response indicates success
      if (response.success) {
        let messagesData = response.success;
        let idSender = response.IDSender;

        console.log(idSender);
        console.log(messagesData);

        messagesData.forEach(function (element) {
          // Create a new li element
          var li = document.createElement("li");

          // Create new elements for the message
          var p = document.createElement("p");
          var span = document.createElement("span");

          if (element.IDUtente == idSender) {
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
      else {
        //if I have no one to chat with

        let bodyMessages = document.getElementById("body-of-messages");

        bodyMessages.innerHTML = "";

        bodyMessages.innerHTML = `
          <div class="d-flex justify-content-center align-items-center style="height:100%;width:100%;">
            <p>
              start chatting with someone
            </p>
          </div>
      `;

      }
    }
  };

  // Make the POST request using FetchPost
  FetchPost(path, body, callback);
}

/* load user profile */

function LoadUserProfile() {
  const path = "inc/loadUserProfile.inc.php";
  const body = {}; // No body required for this request

  // Callback function to handle the response
  const callback = function (response, error) {
    if (error) {
      // Handle errors or other responses here
      console.error("Request failed:", error);
    } else {
      // Clear previous content
      const userProfileElement = document.getElementById("profile-container");
      userProfileElement.innerHTML = "";

      if (response.error) {
        // Display the error message
        userProfileElement.innerHTML = `<p>Error: ${response.error}</p>`;
      } else if (response.success) {
        // Extract user data from success response
        const userData = response.success;

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
    }
  };

  // Make the POST request using FetchPost
  FetchPost(path, body, callback);
}

