<?php

    $num   = $_GET["num"];
    $page   = $_GET["page"];

    include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php";
    $sql = "select * from faq_board where faq_num = $num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $copied_name = $row["file_copied"];

	if ($copied_name)
	{
		$file_path = "./data/".$copied_name;
		unlink($file_path);
    }

    $sql = "delete from faq_board where faq_num = $num";
    mysqli_query($con, $sql);
    mysqli_close($con);

    echo "
	     <script>
	         location.href = 'fnq_main.php?page=$page';
	     </script>
	   ";
?>

