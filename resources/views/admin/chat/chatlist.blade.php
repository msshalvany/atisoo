@extends('admin.layout.layout')
@section('css')
    <style>
        .chat-list-con {
            width: 100%;
        }

        .chat-list-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 5px 40px 5px 40px;
            background: #dddddd;
            margin: 16px 0 0 0;
            border-radius: 20px;
            position: relative;
        }

        .chat-list-item span {
            position: absolute;
            top: 18px;
            left: 120px;
        }

        .chat-list-item img {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }

        .counr-notsee {
            background: #ff2f2f;
            width: 25px;
            height: 25px;
            text-align: center;
            line-height: 25px;
            color: white;
            font-weight: bold;
            border-radius: 50%;
            position: absolute;
            top: 0
        }

        .chat-list-items-con {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
    </style>
@endsection
@section('content')
    <div class="container chat-list-items-con">
        <form class="" action="{{ route('chatlistSearch') }}">
            <input required style="width: 240px;display: inline" class="form-control" name="text" type="text">
            <input type="submit" value="جستوجو" class="btn btn-primary">
        </form><br>
        <a class="blue-btn" href="{{ route('readyMessegeV') }}">متن های اماده</a>
        <div class="set-time-con">
            <button class="btn btn-sm btn-success  show-set-time-btn">تایین زمان انلاین شدن</button>
            <div class="set-time-form">
                <form action="{{ route('setTime') }}" method="POST">
                    @csrf
                    <div>
                    </div>
                    ساعت : <input min="0" max="12" name="hour" type="number" value="0">
                    دقیقه : <input min="0" max="59" name="minute" type="number" value="0"><br><br>
                    <input type="submit" value="set" class="btn btn-primary">
                </form>

            </div>
        </div>
    </div>
    @if ($status == 'show')
        {{-- ====================show========================== --}}
        {{-- ====================show========================== --}}
        {{-- ====================show========================== --}}
        @if ($chats->hasPages())
            <ul class="pagination pagination" style="display: flex">
                {{-- Previous Page Link --}}
                @if ($chats->onFirstPage())
                    <li class="disabled"><span>«</span></li>
                @else
                    <li><a href="{{ $chats->appends(request()->input())->previousPageUrl() }}" rel="prev">«</a>
                    </li>
                @endif

                @if ($chats->currentPage() > 3)
                    <li class="hidden-xs"><a href="{{ $chats->appends(request()->input())->url(1) }}">1</a></li>
                @endif
                @if ($chats->currentPage() > 4)
                    <li><span>...</span></li>
                @endif
                @foreach (range(1, $chats->lastPage()) as $i)
                    @if ($i >= $chats->currentPage() - 2 && $i <= $chats->currentPage() + 2)
                        @if ($i == $chats->currentPage())
                            <li class="active"><span>{{ $i }}</span></li>
                        @else
                            <li><a href="{{ $chats->appends(request()->input())->url($i) }}">{{ $i }}</a>
                            </li>
                        @endif
                    @endif
                @endforeach
                @if ($chats->currentPage() < $chats->lastPage() - 3)
                    <li><span>...</span></li>
                @endif
                @if ($chats->currentPage() < $chats->lastPage() - 2)
                    <li class="hidden-xs"><a href="{{ $chats->url($chats->lastPage()) }}">{{ $chats->lastPage() }}</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($chats->hasMorePages())
                    <li><a href="{{ $chats->appends(request()->input())->nextPageUrl() }}" rel="next">»</a>
                    </li>
                @else
                    <li class="disabled"><span>»</span></li>
                @endif
            </ul>
        @endif
        <div class="chat-list-con">
            @foreach ($chats as $item)
                @php
                    $user = \App\Models\user::find($item->user_id);
                    $chat = \App\Models\chate::find($item->id);
                    $last_mess = \App\Models\messegeChat::where('chate_id', $chat->id)->max('id');
                    $last_mess = \App\Models\messegeChat::find($last_mess);
                @endphp
                <div class="chat-list-item"
                    onclick="location.href='{{ route('chatAdmin', ['chate_id' => $item->id, 'user_id' => $user->id]) }}'">
                    <div>
                        <div style="font-weight: bold;font-size: 20px">{{ $user->name }}</div>
                        <div style="font-weight: bold;font-size: 12px">{{ $user->phon }}</div>
                        @if ($last_mess != null)
                            <span style="font-size: 8px">{{ $last_mess->updated_at }}</span>
                            <p><b class="text-bg-warning"> {{$user->frind}} :</b> {!! $last_mess->text !!}</p>
                            @if ($last_mess->text == '')
                                <i class="icon-file"></i>
                            @endif
                        @endif
                    </div>
                    <div style="position: relative;">
                        {{-- <img width="" style="border-radius:50%;order: 2" src="/{{ $user->image }}" alt=""> --}}
                        @php
                            $last = \App\Models\messegeChat::where('chate_id', $item->id)
                                ->where('user_id', '!=', 0)
                                ->max('id');
                        @endphp
                        @if ($last != $item->see_admin)
                            <div style="order: 1" class="counr-notsee">
                                پیام
                            </div>
                        @endif
                        <!-- <p>last messege : {{ $last }}</p>-->
                        <!--<p>last see admin :{{ $item->see_admin }}</p>-->
                    </div>
                </div>
            @endforeach
        </div>
        @if ($chats->hasPages())
            <ul class="pagination pagination" style="display: flex">
                {{-- Previous Page Link --}}
                @if ($chats->onFirstPage())
                    <li class="disabled"><span>«</span></li>
                @else
                    <li><a href="{{ $chats->appends(request()->input())->previousPageUrl() }}" rel="prev">«</a></li>
                @endif

                @if ($chats->currentPage() > 3)
                    <li class="hidden-xs"><a href="{{ $chats->appends(request()->input())->url(1) }}">1</a></li>
                @endif
                @if ($chats->currentPage() > 4)
                    <li><span>...</span></li>
                @endif
                @foreach (range(1, $chats->lastPage()) as $i)
                    @if ($i >= $chats->currentPage() - 2 && $i <= $chats->currentPage() + 2)
                        @if ($i == $chats->currentPage())
                            <li class="active"><span>{{ $i }}</span></li>
                        @else
                            <li><a href="{{ $chats->appends(request()->input())->url($i) }}">{{ $i }}</a>
                            </li>
                        @endif
                    @endif
                @endforeach
                @if ($chats->currentPage() < $chats->lastPage() - 3)
                    <li><span>...</span></li>
                @endif
                @if ($chats->currentPage() < $chats->lastPage() - 2)
                    <li class="hidden-xs"><a href="{{ $chats->url($chats->lastPage()) }}">{{ $chats->lastPage() }}</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($chats->hasMorePages())
                    <li><a href="{{ $chats->appends(request()->input())->nextPageUrl() }}" rel="next">»</a>
                    </li>
                @else
                    <li class="disabled"><span>»</span></li>
                @endif
            </ul>
        @endif
        {{-- ====================show========================== --}}
        {{-- ====================show========================== --}}
        {{-- ====================show========================== --}}

        {{-- ====================search========================== --}}
        {{-- ====================search========================== --}}
        {{-- ====================search========================== --}}
    @else
        <div class="chat-list-con">
            @foreach ($chats as $item)
                @php
                    $user = \App\Models\user::find($item->user_id);
                @endphp
                <div class="chat-list-item"
                    onclick="location.href='{{ route('chatAdmin', ['chate_id' => $item->id, 'user_id' => $user->id, 'goTo' => $item->goTo]) }}'">
                    <div>
                        <div style="font-weight: bold;font-size: 20px">{{ $user->name }}</div>
                        <div style="font-weight: bold;font-size: 12px">{{ $user->phon }}</div>
                        <p>{{ $item->text }}</p>
                    </div>
                    <div style="position: relative;">
                        {{-- <img width="" style="border-radius:50%;order: 2" src="/{{ $user->image }}" alt=""> --}}
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    {{-- ====================search========================== --}}
    {{-- ====================search========================== --}}
    {{-- ====================search========================== --}}
@endsection
