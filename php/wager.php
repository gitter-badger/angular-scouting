<?php
$postData = json_decode(file_get_contents("php://input"));
if($postData["wagerType"] == "alliance") {
    $query = "INSERT INTO wagers (associatedId, wagerType, wageredByteCoins, matchPredicted, alliancePredicted)
    VALUES (?, ?, ?, ?, ?)";
    if($stmt = $db->prepare($query)){
    $stmt->bind_param("isiis",
		$postData["associatedId"],
		$postData["wagerType"],
		$postData["wageredByteCoins"],
		$postData["matchPredicted"],
		$postData["alliancePredicted"]);
	$stmt->execute();
    }
    else {
        die("Failed to upload alliance");
    }
}
} else if ($postData["wagerType"] == "closeMatch") {
    $query = "INSERT INTO wagers (associatedId, wagerType, wageredByteCoins, matchPredicted, withenPoints)
    VALUES (?, ?, ?, ?, ?)";
    if($stmt = $db->prepare($query)){
    $stmt->bind_param("isiii",
		$postData["associatedId"],
		$postData["wagerType"],
		$postData["wageredByteCoins"],
		$postData["matchPredicted"],
		$postData["withenPoints"]);
	$stmt->execute();
    } else {
        die("Failed to upload closeMatch");
    }
} else if ($postData["wagerType"] == "points") {
        $query = "INSERT INTO wagers (associatedId, wagerType, wageredByteCoins, matchPredicted, alliancePredicted, withenPoints)
    VALUES (?, ?, ?, ?, ?, ?)";
    if($stmt = $db->prepare($query)){
    $stmt->bind_param("isiisi",
		$postData["associatedId"],
		$postData["wagerType"],
		$postData["wageredByteCoins"],
		$postData["matchPredicted"],
		$postData["alliancePredicted"]);
		$postData["withenPoints"]);
	$stmt->execute();
    }
    else {
    	header($_SERVER['SERVER_PROTOCOL'] . ' 500 SQL Error', true, 500);
        die("Failed to upload points");
    }
}
$db->close();
?>
