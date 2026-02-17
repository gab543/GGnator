<?php
session_start();

require_once './utils/functions.php';
require_once './utils/queries.php';

if (!isConnected()) {
    header('Location: login.php');
    exit;
}

$error = null;
$question = null;
$result = null;

if (isset($_POST['answer'], $_POST['question_id'])) {
    $questionId = (int) $_POST['question_id'];
    $answer = $_POST['answer'];

    $response = getResponse($questionId, $answer);

    if (!$response) {
        $error = "Aucune réponse trouvée pour question_id=$questionId et answer=$answer";
    } elseif ($response['next_question_id']) {
        $question = getQuestionById($response['next_question_id']);
        if (!$question) {
            $error = "Question suivante non trouvée (id: " . $response['next_question_id'] . ")";
        }
    } elseif ($response['result_id']) {
        saveGame($_SESSION['user']['id'], $response['result_id']);
        $result = getResultById($response['result_id']);
    }
} else {
    $question = getFirstQuestion();
    if (!$question) {
        $error = "Aucune question de départ trouvée";
    }
}

$template = './templates/quiz.phtml';
include_once './templates/layout.phtml';
