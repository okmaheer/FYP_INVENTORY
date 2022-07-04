
    @if(isset($search))
<footer class="p-3  ">
    <div class="d-flex px-3 py-2 SearchBtnFooter  justify-content-between">
     
    
        <div class="d-flex w-90 align-items-center">
            <form action="{{ route('live.search') }}" method="POST">
                @csrf
<div class="row">
  
        <div class="">
            <i class="fal  fa-search ml-2 mr-3 mt-2"></i>
        </div>
        <div class="">
    <input type="text" placeholder="Buscar en doctores.hn" name="search" id="searchbar"/>
</div>
</div>
        </div>
    
        <div>
         <button class="senderFooterBtn position-relative" type="submit"  onclick="liveSearch();">
             <i class="fas fa-paper-plane animate__animated "></i>

         </button>
        </form>
        </div>
    </div>
</footer>

    
@else
  <footer class="p-3 border-top ">
    <div class="d-flex px-3 py-2 SearchBtnFooter  justify-content-between">
     
    
        <div class="d-flex w-90 align-items-center">
          
<div class="row">
  
        <div class="">
            <i class="fal  fa-search ml-2 mr-3 mt-2"></i>
        </div>
        <div class="">
    <input type="text" placeholder="Buscar en doctores.hn" name="search" id="searchbar"/>
</div>
</div>
        </div>
    
        <div>
         <button class="senderFooterBtn position-relative" type="submit"  onclick="liveSearch();">
             <i class="fas fa-paper-plane animate__animated "></i>

         </button>
        </form>
        </div>
    </div>
</footer>  
@endif
@include('dashboard.accounts.doctor.live-search')

</body>
</html>
