<?php

namespace app\api\controller;

/**
 * 开放接口
 */
class News
{

  	//获取新闻接口
  	public function index()
    {		

    	    $appkey = 'd1518b1f7d0d467967269ca2b283f435';//你的appkey
            $channel=  'caijing';//类型,,top(头条，默认),shehui(社会),guonei(国内),guoji(国际),yule(娱乐),tiyu(体育)junshi(军事),keji(科技),caijing(财经),shishang(时尚)
            $url = "http://v.juhe.cn/toutiao/index?type=$channel&key=$appkey";
            $json = file_get_contents($url);
            $jsonarr = json_decode($json, true);

             if ($jsonarr['reason'] == '超过每日可允许请求次数!') {
                echo '<center><h1>超过每日可允许请求次数！</h1></center>';
                die;
             }
            echo '<table border="1" width="600" align="center">';
            echo '<th>发布日期</th><th>文章封面</th><th>标题</th><th>文章类型</th><th>文章来源</th><th>文章链接</th>';

            foreach($jsonarr['result']['data'] as $key => $value) {
                echo '<tr>';
                    echo '<td>'.$value['date'].'</td>';
                    echo '<td><img width="140" height="120" src="'.$value['thumbnail_pic_s'].'" /></td>';
                    echo '<td>'.$value['title'].'</td>';
                    echo '<td>'.$value['category'].'</td>';
                    echo '<td>'.$value['author_name'].'</td>';
                    echo '<td><a href="'.$value['url'].'"  target="view_window">文章详情</a></td>';
                echo '</tr>';

            }

            echo '</table>';

  
    
    }


}
