<?php
include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/movie_info.php";

//$movie = Movie_info::getMovieInfo_ByCode(183866, $con);
//print_r($movie);

// 스틸컷 가져와서 저장
function save_StillCut($mv_num, $con)
{
    $data = file_get_html("https://movie.naver.com/movie/bi/mi/photoView.nhn?code={$mv_num}");
    $image = $data->find('#photo_area > div > div.list_area._list_area > div > ul > li');

    foreach ($image as $item) {
        $img = $item->attr['data-json'];
        $img = json_decode($img);
        $still_cut[] = $img->fullImageUrl665px;
        $sql = "insert into `movie_img`(mv_num, mi_img_path) values({$mv_num}, '{$img->fullImageUrl665px}');";
        mysqli_query($con, $sql);
    }
}

// 웹 상에서 파일 가져올 수 있는 것을 막아논 것을 푸는 함수
//ini_set("allow_url_fopen", 1);


// html을 url상에서 가져올 수 있는 함수 simple_html_dom.php 여기에 정의되어 있는 함수임
//$data = file_get_html("https://movie.naver.com/movie/bi/mi/basic.nhn?code=39841");
//
//foreach ($data->find('div.mv_info > dl > dd:nth-child(2) > p > span') as $e) {
//    $items[] = $e->plaintext;
//}
//
////-------------------------------보완 필요
//$movie_info['genre'] = $items[0];
//
////var_dump($movie_info['genre']);
//
//function trim_array($text)
//{
//    $text = explode(",", $text);
//
//    for ($i = 0; $i < count($text); ++$i) {
//        $text[$i] = trim($text[$i]);
//    }
//    return $text;
//}
//
//
//var_dump($text);

//$movie_info2 = explode(',' , $text);
//print_r($movie_info2);
