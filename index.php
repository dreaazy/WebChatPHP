<?php

include __DIR__ . "/dmo/utente.inc.php";
require_once __DIR__ . "/inc/config.php";

session_start();

/* if (isset($_SESSION["id_user_message"])) {
    echo $_SESSION["id_user_message"]; // Pass PHP variable to JavaScript
}
 */


if (isset($_SESSION["user_id"])) {
    /* echo $_SESSION["user_id"]; */
} else {
    header("Location: signin.php");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <!-- new -->

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/chat-style.css">
    <title>Chat Layout</title>
</head>

<body>

    <!-- char-area -->
    <section class="message-area">

        <div class="container">

            <?php include __DIR__ . '/tmpl/navbar.php'; ?>
            <div class="row">
                <div class="col-12">
                    <div class="chat-area">
                        <!-- chatlist -->
                        <div class="chatlist">
                            <div class="modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="chat-header">

                                        <form class="msg-search" id="searchForm" method="GET">


                                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="searchValue">

                                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                        </form>

                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="Open-tab" data-bs-toggle="tab" data-bs-target="#Open" type="button" role="tab" aria-controls="Open" aria-selected="true">My chats</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="Closed-tab" data-bs-toggle="tab" data-bs-target="#Closed" type="button" role="tab" aria-controls="Closed" aria-selected="false">Discover</button>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="modal-body">
                                        <!-- chat-list -->
                                        <div class="chat-lists">
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="Open" role="tabpanel" aria-labelledby="Open-tab">

                                                    <!-- OLD CHATS / FRIENDS-->
                                                    <!-- chat-list -->
                                                    <div class="chat-list">

                                                    </div>
                                                    <!-- chat-list -->
                                                </div>
                                                <div class="tab-pane fade" id="Closed" role="tabpanel" aria-labelledby="Closed-tab" tabindex="-1">

                                                    <!-- CLOSED LIST OF CHAT BOX -->
                                                    <div class="chat-list" id="chat-list">

                                                        <!-- DINAMICALLY RENDERED -->


                                                    </div>
                                                    <!-- chat-list -->
                                                </div>
                                            </div>

                                        </div>
                                        <!-- chat-list -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- chatlist -->



                        <!-- chatbox -->
                        <div class="chatbox">
                            <div class="modal-dialog-scrollable">
                                <div class="modal-content">


                                    <div class="msg-head" id="head-chatting-user">
                                        <div class="row">


                                            <!-- PROFILE INFORMATION OF CHATBOX -->
                                            <div class="col-8">
                                                <div class="d-flex align-items-center">
                                                    <!-- IMG CHATBOX -->
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
                                    </div>


                                    <div class="modal-body">
                                        <div class="msg-body">
                                            <ul id="msg-body-list">                                                
                                                <!-- DINAMICALLY -->
                                            </ul>
                                        </div>
                                    </div>


                                    <div class="send-box">
                                        <form action="" onsubmit="return SendMessage()">
                                            <input type="text" class="form-control" aria-label="message…" placeholder="Write message…" id="input-text-message">
                                            <button type="button" onclick="return SendMessage()">
                                                <i class="fa fa-paper-plane" aria-hidden="true"></i> Send
                                            </button>
                                        </form>


                                        <div class="send-btns">
                                            <div class="attach">
                                                <div class="button-wrapper">
                                                    <span class="label">
                                                        <img class="img-fluid" src="https://mehedihtml.com/chatbox/assets/img/upload.svg" alt="image title"> attached file
                                                    </span><input type="file" name="upload" id="upload" class="upload-box" placeholder="Upload File" aria-label="Upload File">
                                                </div>

                                                <select class="form-control" id="exampleFormControlSelect1">
                                                    <option>Select template</option>
                                                    <option>Template 1</option>
                                                    <option>Template 2</option>
                                                </select>

                                                <div class="add-apoint">
                                                    <a href="#" data-toggle="modal" data-target="#exampleModal4"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewbox="0 0 16 16" fill="none">
                                                            <path d="M8 16C3.58862 16 0 12.4114 0 8C0 3.58862 3.58862 0 8 0C12.4114 0 16 3.58862 16 8C16 12.4114 12.4114 16 8 16ZM8 1C4.14001 1 1 4.14001 1 8C1 11.86 4.14001 15 8 15C11.86 15 15 11.86 15 8C15 4.14001 11.86 1 8 1Z" fill="#7D7D7D" />
                                                            <path d="M11.5 8.5H4.5C4.224 8.5 4 8.276 4 8C4 7.724 4.224 7.5 4.5 7.5H11.5C11.776 7.5 12 7.724 12 8C12 8.276 11.776 8.5 11.5 8.5Z" fill="#7D7D7D" />
                                                            <path d="M8 12C7.724 12 7.5 11.776 7.5 11.5V4.5C7.5 4.224 7.724 4 8 4C8.276 4 8.5 4.224 8.5 4.5V11.5C8.5 11.776 8.276 12 8 12Z" fill="#7D7D7D" />
                                                        </svg> Appoinment</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- chatbox -->


                </div>
            </div>
        </div>
        </div>
    </section>



    <!-- footer -->
    <?php include __DIR__ . '/tmpl/footer.php'; ?>


    <script src="js/main.js"></script>

    <script>
        //check if there if the user is chatting with someone
        document.addEventListener("DOMContentLoaded", function() {

            LoadUserProfile();
            CaricaChattingUser();
            FetchMessages();
        });
        
        
    </script>

    
</body>

</html>