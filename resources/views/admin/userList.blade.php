 @extends('admin.layout.layout')
 @section('content')
     <div class="row">
         <h3 style="margin-right: 12px"><b>تعداد کاربران : {{ $count }}</b></h3>
         <div class="col-lg-12">
            <form class="container row" action="{{ route('userSearch') }}">
                <input style="width: 240px;display: inline" class="form-control" name="text" type="text">
                <input type="submit" value="جستوجو" class="btn btn-primary">
            </form>
            <br>
             <section class="panel">
                 <header class="panel-heading">
                     لیست کابران
                 </header>
                 @if ($user->hasPages())
                     <ul class="pagination pagination" style="display: flex">
                         {{-- Previous Page Link --}}
                         @if ($user->onFirstPage())
                             <li class="disabled"><span>«</span></li>
                         @else
                             <li><a href="{{ $user->appends(request()->input())->previousPageUrl() }}" rel="prev">«</a>
                             </li>
                         @endif

                         @if ($user->currentPage() > 3)
                             <li class="hidden-xs"><a href="{{ $user->appends(request()->input())->url(1) }}">1</a></li>
                         @endif
                         @if ($user->currentPage() > 4)
                             <li><span>...</span></li>
                         @endif
                         @foreach (range(1, $user->lastPage()) as $i)
                             @if ($i >= $user->currentPage() - 2 && $i <= $user->currentPage() + 2)
                                 @if ($i == $user->currentPage())
                                     <li class="active"><span>{{ $i }}</span></li>
                                 @else
                                     <li><a href="{{ $user->appends(request()->input())->url($i) }}">{{ $i }}</a>
                                     </li>
                                 @endif
                             @endif
                         @endforeach
                         @if ($user->currentPage() < $user->lastPage() - 3)
                             <li><span>...</span></li>
                         @endif
                         @if ($user->currentPage() < $user->lastPage() - 2)
                             <li class="hidden-xs"><a href="{{ $user->url($user->lastPage()) }}">{{ $user->lastPage() }}</a>
                             </li>
                         @endif

                         {{-- Next Page Link --}}
                         @if ($user->hasMorePages())
                             <li><a href="{{ $user->appends(request()->input())->nextPageUrl() }}" rel="next">»</a></li>
                         @else
                             <li class="disabled"><span>»</span></li>
                         @endif
                     </ul>
                 @endif
                 <table class="table table-striped table-advance table-hover">
                     <thead>
                         <tr>
                             <td>نام</td>
                             <td>id</td>
                             <td>شماره</td>
                             <td>نام مغازه</td>
                             <td>شهر</td>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($user as $user)
                             <tr>
                                 <td>{{ $user->name }}</td>
                                 <td>{{ $user->id }}</td>
                                 <td>{{ $user->phon }}</td>
                                 <td>{{ $user->stor }}</td>
                                 <td>{{ $user->city }}</td>
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
             </section>
         </div>
         @if ($count == 0)
             <div style="text-align: center">موردی یافت نشد</div><br>
             <a style="text-align: center;display: block;" class="btn btn-primary" href="/dashbord/userList">برگشت</a>
         @endif
     </div>
 @endsection
