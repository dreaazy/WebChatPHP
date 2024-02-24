<?php

class UtenteBL
{

    public $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    //
    public function GetUserByUsername($username, $exactUsername = false)
    {

        if ($exactUsername == true) {

            $name = $username;
            $query = "SELECT * FROM utenti WHERE username = ?";
        } else {
            $name = "%" . $username . "%";
            $query = "SELECT * FROM utenti WHERE username LIKE ? ORDER BY username DESC";
        }

        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            return json_encode(['error' => "Error preparing statement: " . $this->conn->error]);
        }

        $stmt->bind_param("s", $name);

        if ($stmt->execute()) {

            $result = $stmt->get_result();
            $userData = array();

            while ($row = $result->fetch_assoc()) {
                $userData[] = $row;
            }

            return json_encode($userData);
        } else {
            return json_encode(['error' => "Error executing statement: " . $stmt->error]);
        }

        $stmt->close();
    }

    public function getUserIDByUsername($username)
    {
        $query = "SELECT ID FROM utenti WHERE username = ? LIMIT 1";

        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            return json_encode(['error' => "Error preparing statement: " . $this->conn->error]);
        }

        $stmt->bind_param("s", $username);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                return $row['ID']; // Return the user ID
            } else {
                return null; // No user found with that username
            }
        } else {
            return json_encode(['error' => "Error executing statement: " . $stmt->error]);
        }

        $stmt->close();
    }

    public function updateUserAttribute($userID, $attributeName, $attributeValue)
    {
        // Check if the attribute exists in the table
        $validAttributes = array('username', 'Nome', 'Cognome', 'Email', 'Cell', 'Bannato', 'DataFineBan', 'UltimaVoltaOnline', 'img'); // List of valid attributes

        if (!in_array($attributeName, $validAttributes)) {
            return json_encode(['error' => "Invalid attribute name: $attributeName"]);
        }

        // Prepare the update query
        $query = "UPDATE utenti SET $attributeName = ? WHERE ID = ?";
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            return json_encode(['error' => "Error preparing statement: " . $this->conn->error]);
        }

        // Bind parameters and execute the statement
        $stmt->bind_param("si", $attributeValue, $userID);
        if ($stmt->execute()) {
            // Check if any rows were affected
            if ($stmt->affected_rows > 0) {
                return json_encode(['success' => "Attribute '$attributeName' updated successfully for user with ID: $userID"]);
            } else {
                return json_encode(['error' => "No rows updated for user with ID: $userID"]);
            }
        } else {
            return json_encode(['error' => "Error executing statement: " . $stmt->error]);
        }

        // Close the statement
        $stmt->close();
    }

    // user x join a conversation y
    public function JoinAConversation($IDUtente, $IDConversazione)
    {
        // Prepare the update query
        $query = "INSERT INTO partecipare (DataUnione, UltimaLettura, IDUtente, IDConversazione) VALUES (NOW(), null, ?, ?)";

        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            return json_encode(['error' => "Error preparing statement: " . $this->conn->error]);
        }

        $stmt->bind_param("ii", $IDUtente, $IDConversazione);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                return json_encode(['success' => "the user $IDUtente joined the conversation $IDConversazione"]);
            } else {
                return json_encode(['error' => "No rows inserted for user with ID: $IDUtente"]);
            }
        } else {
            return json_encode(['error' => "Error executing statement: " . $stmt->error]);
        }

        // Close the statement
        $stmt->close();
    }


    public function MessageAConversation($IDMittente, $IDconversazione, $testo)
    {
        // Prepare the insert query
        $query = "INSERT INTO messaggi (Contenuto, DataCreazione, IDUtente, IDConversazione) VALUES (?, NOW(), ?, ?)";

        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            return json_encode(['error' => "Error preparing statement: " . $this->conn->error]);
        }

        $stmt->bind_param("sii", $testo, $IDMittente, $IDconversazione);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                return json_encode(['success' => "Message inserted into conversation $IDconversazione"]);
            } else {
                return json_encode(['error' => "No rows inserted"]);
            }
        } else {
            return json_encode(['error' => "Error executing statement: " . $stmt->error]);
        }

        // Close the statement
        $stmt->close();
    }

    public function CreateAConversation($tipologia)
    {
        // Prepare the insert query
        $query = "INSERT INTO conversazioni (Tipologia, DataCreazione) VALUES (?, NOW())";

        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            return json_encode(['error' => "Error preparing statement: " . $this->conn->error]);
        }

        $stmt->bind_param("s", $tipologia);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $conversationId = $stmt->insert_id;
                return json_encode(['success' => "Conversation created with ID: $conversationId", 'conversation_id' => $conversationId]);
            } else {
                return json_encode(['error' => "No rows inserted"]);
            }
        } else {
            return json_encode(['error' => "Error executing statement: " . $stmt->error]);
        }

        // Close the statement
        $stmt->close();
    }


    public function CheckConversationExistenceBetweenUsers($userID1, $userID2)
    {
        // Prepare the select query
        $query = "SELECT IDConversazione, COUNT(ID) FROM partecipare WHERE IDUtente = ? OR IDUtente = ? GROUP BY IDConversazione HAVING COUNT(ID) = 2";

        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            return json_encode(['error' => "Error preparing statement: " . $this->conn->error]);
        }

        $stmt->bind_param("ii", $userID1, $userID2);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $conversationId = $row['IDConversazione'];
                return json_encode(['exists' => true, 'conversation_id' => $conversationId, 'message' => "Conversation between users $userID1 and $userID2 exists"]);
            } else {
                return json_encode(['exists' => false, 'message' => "No conversation between users $userID1 and $userID2"]);
            }
        } else {
            return json_encode(['error' => "Error executing statement: " . $stmt->error]);
        }

        // Close the statement
        $stmt->close();
    }

    public function GetUserById($userId)
    {
        $query = "SELECT * FROM utenti WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            return json_encode(['error' => "Error preparing statement: " . $this->conn->error]);
        }

        $stmt->bind_param("i", $userId);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            // Fetch user data
            if ($row = $result->fetch_assoc()) {
                return json_encode(['success' => $row]);
            } else {
                return json_encode(['error' => "User with ID $userId not found."]);
            }
        } else {
            return json_encode(['error' => "Error executing statement: " . $stmt->error]);
        }

        $stmt->close();
    }

    //restituisce gli id degli utenti che hanno una conversazione aperta (partecipano ad una conversazione) con un utente (ID dell'utente loggato)
    public function GetUsersOfOpenChats($userId)
    {
        $query = "SELECT ut.*
              FROM (
                  SELECT pa.IDUtente AS IDUtente
                  FROM partecipare AS pa
                  JOIN conversazioni AS co ON co.ID = pa.IDConversazione
                  WHERE co.ID IN (
                      SELECT c.ID
                      FROM conversazioni AS c
                      JOIN partecipare AS p ON p.IDConversazione = c.ID
                      JOIN utenti AS a ON a.ID = p.IDUtente
                      WHERE a.ID = ?
                  )
              ) AS UserConversation
              JOIN utenti AS ut ON ut.ID = UserConversation.IDUtente
              WHERE UserConversation.IDUtente <> ?";

        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            return json_encode(['error' => "Error preparing statement: " . $this->conn->error]);
        }

        $stmt->bind_param("ii", $userId, $userId);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $users = [];

            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }

            if (!empty($users)) {
                return json_encode(['success' => $users]);
            } else {
                return json_encode(['error' => "No open chats found for user $userId"]);
            }
        } else {
            return json_encode(['error' => "Error executing statement: " . $stmt->error]);
        }

        $stmt->close();
    }
}
