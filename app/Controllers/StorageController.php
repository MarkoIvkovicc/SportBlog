<?php

namespace App\Controllers;

class StorageController
{
	public function uploadImage()
	{
		$targetDir = "storage/images/profil/";
		$targetFile = $targetDir . basename($_FILES["image"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

		// Check if file already exists
		if (file_exists($targetFile)) {
			return $targetFile;
		}

		// Check if image file is an actual image or a fake image
		if (isset($_POST["submit"])) {
			$check = getimagesize($_FILES["image"]["tmp_name"]);
			if (!$check !== false) {
				$uploadOk = 0;
			}
		}

		// Check file size
		if ($_FILES["image"]["size"] > 500000) {
			echo "velika";
			exit();
			$uploadOk = 0;
		}

		// Allow certain file formats
		if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			$uploadOk = 0;
		}

		if ($uploadOk == 0) {
			echo "file could not be uploaded";
			exit();
		} else {
			if (! is_dir($targetDir)) {
				mkdir('./' . $targetDir, 0777, true);
			}
			if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
				return $targetFile;
			} else {
				echo "Sorry, there was an error uploading your file.";
				exit();
			}
		}
	}

	public function getImage()
	{
		return $this->uploadImage();
	}

	public function deleteImage ($image)
	{
		if (is_dir($image)) {
			unlink($image);
		}
	}
}