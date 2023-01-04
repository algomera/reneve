@if (session('message'))
<div class="message absolute right-[4%] py-3 px-5 my-4 bg-slate-500/50 rounded text-white uppercase tracking-[0.5px] z-10 ease-in duration-700 transition-opacity">
    <strong>{{ session('message')}}</strong>
</div>

<script>
    var myVar = setInterval(Timer, 3000);
    function Timer() {
        document.querySelector('.message').style.display = 'none';
    }
</script>
@endif
