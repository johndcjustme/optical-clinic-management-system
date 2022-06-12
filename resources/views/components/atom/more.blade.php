<style>
    .btn_post_option:hover {
        color: black;
    }

</style>


<div class="dropdown dropdown-left">
    <label tabindex="0" class="btn btn-circle btn-ghost btn-sm"><i class="fa-solid fa-ellipsis-vertical"></i></label>
    <ul tabindex="0" class="dropdown-content menu p-2 m-1 drop-shadow-2xl bg-base-100 rounded-box w-47">
        {{ $slot }}
    </ul>
</div>
