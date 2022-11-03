
<!-- BEGIN: Pagination -->
<div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
    @if ($paginator->hasPages())
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : $this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1)

        <nav class="w-full sm:w-auto sm:mr-auto">
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link" href="#">
                        <i class="w-4 h-4" data-feather="chevrons-left"></i>
                    </a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link" href="#">
                        <i class="w-4 h-4" data-feather="chevron-left"></i>
                    </a>
                </li>

            @else

                <li class="page-item"  wire:click="firstPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled">
                    <a class="page-link" href="#">
                        <i class="w-4 h-4" data-feather="chevrons-left"></i>
                    </a>
                </li>
                <li class="page-item" wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled">
                    <a class="page-link" href="#">
                        <i class="w-4 h-4" data-feather="chevron-left"></i>
                    </a>
                </li>


            @endif


            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item">
                        <a class="page-link" href="#">...</a>
                    </li>                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"  wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}">
                                <a class="page-link" href="#">{{$page}}</a>
                            </li>
                        @else
                            <li class="page-item" wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}" >
                                <button type="button" class="page-link" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">{{ $page }}</button>                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="page-item" wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" >
                    <a class="page-link" href="#">
                        <i class="w-4 h-4" data-feather="chevron-right"></i>
                    </a>
                </li>
                <li class="page-item" wire:click="lastPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" >
                    <a class="page-link" href="#">
                        <i class="w-4 h-4" data-feather="chevrons-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled"  wire:loading.attr="disabled" >
                    <a class="page-link" href="#">
                        <i class="w-4 h-4" data-feather="chevron-right"></i>
                    </a>
                </li>
                <li class="page-item disabled"  wire:loading.attr="disabled" >
                    <a class="page-link" href="#">
                        <i class="w-4 h-4" data-feather="chevrons-right"></i>
                    </a>
                </li>
            @endif

        </ul>
    </nav>
    <select class="w-20 form-select box mt-3 sm:mt-0">
        <option>10</option>
        <option>25</option>
        <option>35</option>
        <option>50</option>
    </select>
    @endif
</div>
<!-- END: Pagination -->
