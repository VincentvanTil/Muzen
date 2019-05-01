@if ($message = Session::get('success'))
    <section class="padding-3" id="flash-message" data-closable>
        <div class="grid-container">
            <div class="grid-x grid-padding-x">
                <div class="small-12 cell">
                    <div class="success callout">
                        <p>{{ $message }}</p>
                        <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif


@if ($message = Session::get('error'))
    <section class="padding-3" id="flash-message" data-closable>
        <div class="grid-container">
            <div class="grid-x grid-padding-x">
                <div class="small-12 cell">
                    <div class="alert callout">
                        <p>{{ $message }}</p>
                        <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif


@if ($message = Session::get('warning'))
    <section class="padding-3" id="flash-message" data-closable>
        <div class="grid-container">
            <div class="grid-x grid-padding-x">
                <div class="small-12 cell">
                    <div class="warning callout">
                        <p>{{ $message }}</p>
                        <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif


@if ($message = Session::get('info'))
    <section class="padding-3" id="flash-message" data-closable>
        <div class="grid-container">
            <div class="grid-x grid-padding-x">
                <div class="small-12 cell">
                    <div class="primary callout">
                        <p>{{ $message }}</p>
                        <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif


@if ($errors->any())
    <section class="padding-3" id="flash-message" data-closable>
        <div class="grid-container">
            <div class="grid-x grid-padding-x">
                <div class="small-12 cell">
                    <div class="alert callout">
                        <ul class="no-bullet">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
