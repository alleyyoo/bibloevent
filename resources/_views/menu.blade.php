<div class="inner-nav desktop-nav">
    <ul class="clearlist">
        @foreach($menu as $child)
            <li>
                <a href="{{ \Illuminate\Support\Facades\URL::to('/').'/'.app()->getLocale().'/'.($child->slug ?? '/') }}" class="{{ (isset($page) ? $page->activeLink($child->id) : $loop->first) ? 'active' : '' }}">{{ $child->title }}</a>
            </li>
        @endforeach
        @if (count(config('languages')) > 1)
            <li>
                <a href="#" class="mn-has-sub">{{ strtoupper(config('app.locale')) }} <i class="fa fa-angle-down"></i></a>
                <ul class="mn-sub">
                    @foreach(config('languages') as $code => $name)
                        @if (config('app.locale') != $code)
                            <li><a href="{{ route('locale', [ 'locale' => $code ]) }}">{{ strtoupper($code) }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </li>
        @endif
    </ul>
</div>