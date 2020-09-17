<?php

namespace App\Controllers;

class StorageController
{
	public function uploadImage($prefix, $id)
	{
		$fileName = $this->generateRandomString();
		$targetDir = "storage/images/" . $prefix . "/";
		$targetFile = $targetDir . $id . '_' . $fileName;
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION));

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
			$uploadOk = 0;
			echo twig()->render('http-codes/413.html'); return;
		}

		// Allow certain file formats
		if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			$uploadOk = 0;
		}

		if ($uploadOk == 0) {
			echo twig()->render('http-codes/400.html');  
			return;
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

	public function getImage($prefix, $userId)
	{
		return $this->uploadImage($prefix, $userId);
	}

	public function deleteImage ($image)
	{
		if (file_exists($image)) {
			unlink($image);
		}
	}

	private function generateRandomString($length = 15) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}