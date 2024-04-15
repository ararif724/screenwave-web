
<script> 
    const shareUrl = "{{ request()->url() }}";
    const videoIframe = `<iframe frameborder='0' src='{{ $iframeUrl }}' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' allowfullscreen=''></iframe>`;
</script>
<div class="fixed top-0 left-0 w-full hidden items-center justify-center min-h-screen bg-black/30 z-40 p-2" id="share-box"></div>
