
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/analytic_stats.js') }}"></script>


    <script src="{{ asset('js/modal.js') }}"></script>
    
    {{-- 

    <script>

        var textarea = document.getElementById('textarea');
        var i;
    
        textarea.addEventListener('keydown', autosize);
                    
        function autosize(){
        var el = this;
        setTimeout(function(){
            el.style.cssText = 'height:auto; padding:0';
            // for box-sizing other than "content-box" use:
            // el.style.cssText = '-moz-box-sizing:content-box';
            el.style.cssText = 'height:' + el.scrollHeight + 'px';
        },0);
        }
    
    </script> 
    
    --}}
@livewireScripts
</body>
</html>