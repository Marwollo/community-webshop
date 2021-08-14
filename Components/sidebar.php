<script>
    var interval;
    let scrollToTop = () => {
        window.scrollBy(0, -1);
        interval = setInterval(() => {
           
            window.scrollBy(0, -20);
            if (window.scrollY == 0)
                clearInterval(interval);
           
        }, 1/60);
    }
</script>
<div class="s-media">
    <a target="_blank" href="https://wwwa.facebook.com" class="s-item facebook">
    	<span class="fa fa-facebook"></span>
    </a>
    
    <a target="_blank" href="https://www.google.com" class="s-item twitter">
    	<span class="fa fa-twitter"></span>
    </a>
    

    <a target="_blank" href="https://www.gmail.com" class="s-item gplus">
    	<span class="fa fa-google"></span>
    </a>

    <a onclick="scrollToTop();"  href="javascript:void(0)" id="sm-close"  class="s-item print">
        <span class="fa fa-arrow-up"></span>
    </a>

 </div>
<a id="sm-open"  class="s-item print sm-collapse">
    <span class="fa fa-arrow-right"></span>
</a>