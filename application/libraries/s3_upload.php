<?php

/**
 * Amazon S3 Upload PHP class
 *
 * @version 0.1
 */
class S3_upload {

	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('s3');

		$this->CI->config->load('s3', TRUE);
		$s3_config = $this->CI->config->item('s3');

		$this->bucket_name = $s3_config['bucket_name'];
		$this->bucket_name_adb = $s3_config['bucket_name_adb'];
		$this->bucket_name_epub = $s3_config['bucket_name_epub'];

		$this->folder_name = $s3_config['folder_name'];
		$this->folder_name_adb = $s3_config['folder_name_adb'];
		$this->folder_name_epub = $s3_config['folder_name_epub'];
		$this->s3_url = $s3_config['s3_url'];
	}

	function upload_image_file($file_path, $subfolder_name, $file_name) {
		// generate unique filename
		$file = pathinfo($file_path);
		// $s3_file = $file['filename'].'-'.rand(1000,1).'.'.$file['extension'];
		$s3_file = $file_name.'.'.$file['extension'];
		$mime_type = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file_path);

		$saved = $this->CI->s3->putObjectFile(
			$file_path,
			$this->bucket_name,
			$this->folder_name.$subfolder_name.'/'.$s3_file,
			S3::ACL_PUBLIC_READ,
			array(),
			$mime_type
		);
		if ($saved) {
			return 1;//$saved;//$this->s3_url.$this->bucket_name.'/'.$this->folder_name.$subfolder_name.'/'.$s3_file;
		} else {
			return 0;
		}
	}

	function upload_epub_file($file_path, $subfolder_name, $file_name) {
		// generate unique filename
		$file = pathinfo($file_path);
		// $s3_file = $file['filename'].'-'.rand(1000,1).'.'.$file['extension'];
		$s3_file = $file_name.'.'.$file['extension'];
		$mime_type = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file_path);

		$saved = $this->CI->s3->putObjectFile(
			$file_path,
			$this->bucket_name_epub,
			$this->folder_name_epub.$s3_file,
			S3::ACL_PUBLIC_READ,
			array(),
			$mime_type
		);
		if ($saved) {
			return 1;//$saved;//$this->s3_url.$this->bucket_name.'/'.$this->folder_name.$subfolder_name.'/'.$s3_file;
		} else {
			return 0;
		}
	}

	function upload_adb_file($file_path, $subfolder_name, $file_name) {
		// generate unique filename
		$file = pathinfo($file_path);
		// $s3_file = $file['filename'].'-'.rand(1000,1).'.'.$file['extension'];
		$s3_file = $file_name.'.'.$file['extension'];
		$mime_type = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file_path);

		$saved = $this->CI->s3->putObjectFile(
			$file_path,
			$this->bucket_name_adb,
			$this->folder_name_adb.$s3_file,
			S3::ACL_PUBLIC_READ,
			array(),
			$mime_type
		);
		if ($saved) {
			return 1;//$saved;//$this->s3_url.$this->bucket_name.'/'.$this->folder_name.$subfolder_name.'/'.$s3_file;
		} else {
			return 0;
		}
	}

	function file_exists($url) {
		$saved = $this->CI->s3->getObjectInfo(
			// $file_path,
			$this->bucket_name,
			$this->folder_name.$url,
			TRUE
		);
		return $saved;
	}

	function get_adb_file_info($filename) {
		$file_info = $this->CI->s3->getObjectInfo(
			$this->bucket_name_adb,
			$this->folder_name_adb.$filename,
			TRUE
		);
		return $file_info;
	}

	function delete_adb_file($filename) {
		$file_info = $this->CI->s3->deleteObject(
			$this->bucket_name_adb,
			$this->folder_name_adb.$filename
		);
		return $file_info;
	}

	function get_epub_file($filename) {
		$file_exists = $this->CI->s3->getObjectInfo( $this->bucket_name_epub, $this->folder_name_epub.$filename, TRUE );
		if ($file_exists) {
			$object = S3::getObject($this->bucket_name_epub, $this->folder_name_epub.$filename);
			return $object;
		} else {
			return false;
		}

	}



}
