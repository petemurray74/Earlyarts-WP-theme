<?php
$title=urlencode( get_the_title() );
$url=urlencode( get_permalink() );
$excerpt=urlencode(wp_strip_all_tags(get_the_excerpt()));
?>

<p class="ea-social-sharing">
    <span class="ss-ask">Share this post: </span>

    <a rel="external nofollow" class="ss-twitter" href="http://twitter.com/intent/tweet/?text=<?php echo $title; ?>&url=<?php echo $url; ?>" target="_blank"><span class="ss-icon-twitter"></span>Twitter</a>

    <a rel="external nofollow" class="ss-facebook" href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=<?php echo $url; ?>&p[title]=<?php echo $title; ?>" target="_blank" ><span class="ss-icon-facebook"></span>Facebook</a>

    <a rel="external nofollow" class="ss-googleplus" href="https://plus.google.com/share?url=<?php echo $url; ?>" target="_blank" ><span class="ss-icon-googleplus"></span>Google+</a>
    
    <a rel="external nofollow" class="ss-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>&title=<?php echo $title; ?>&summary=<?php echo $excerpt; ?>&source=Earlyarts_Website"><span class="ss-icon-linkedin"></span>LinkedIn</a>
    
</p>    