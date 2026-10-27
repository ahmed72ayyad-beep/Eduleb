<x-app-layout>
    <x-slot name="header">
        <p class="text-sm font-semibold uppercase tracking-wide text-indigo-600">{{ auth()->user()->roles()->first()->name }} dashboard</p>
        <h1 class="mt-1 text-2xl font-bold text-slate-900">Notifications</h1>
    </x-slot>

    @php
        $studentNotifications = $notifications ?? auth()->user()->notifications;
    @endphp

    <main class="min-h-screen bg-slate-50 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-4xl">
            <div class="mb-6 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm text-slate-500">Course updates and account activity.</p>
                    <h2 class="mt-1 text-xl font-bold text-slate-900">{{ $studentNotifications->count() }} notifications
                    </h2>
                </div>
                <span class="text-sm text-slate-500">{{ auth()->user()->unreadNotifications->count() }} unread</span>
            </div>

            @if ($studentNotifications->isNotEmpty())
                <div class="divide-y divide-slate-100 overflow-hidden rounded-xl border border-slate-200 bg-white">
                    @foreach ($studentNotifications as $notification)
                        <article
                            class="flex flex-col gap-4 p-5 sm:flex-row sm:items-start sm:justify-between sm:p-6 {{ $notification->read_at ? '' : 'bg-indigo-50/40' }}">
                            <div class="flex gap-4">
                                <form method="POST"
                                    action="{{ route('notify.delete_notification', $notification->id) }}">
                                    @method('DELETE')
                                    <button title="Delete The notification"
                                        class="mt-1 flex h-9 w-9 shrink-0 items-center justify-center rounded-full {{ $notification->read_at ? 'bg-slate-100 text-slate-500' : 'bg-emerald-100 text-emerald-800' }}"
                                        aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none">
                                            <g transform="scale(1.33333)">
                                                <line x1="14" y1="4" x2="4" y2="14"
                                                    fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="1.5"></line>
                                                <line x1="4" y1="4" x2="14" y2="14"
                                                    fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="1.5"></line>
                                            </g>
                                        </svg></button>
                                </form>
                                <div>
                                    <div class="flex flex-wrap items-center gap-2">
                                        <h2 class="font-bold text-slate-900">
                                            {{ $notification->data['title'] ?? 'Account update' }}</h2>
                                        @unless ($notification->read_at)
                                            <span
                                                class="rounded-full bg-emerald-100 px-2 py-0.5 text-[11px] font-bold uppercase tracking-wide text-emerald-800">New</span>
                                        @endunless
                                    </div>
                                    <p class="mt-1 text-sm leading-6 text-slate-600">
                                        {{ $notification->data['content'] ?? 'There is an update for your Eduleb account.' }}
                                    </p>
                                    <p class="mt-2 text-xs text-slate-500">
                                        {{ $notification->created_at?->diffForHumans() }}</p>
                                    @if (!empty($notification->data['link']))
                                        <a href="{{ $notification->data['link'] }}"
                                            class="mt-3 inline-flex text-sm font-semibold text-indigo-700 hover:text-indigo-900">{{ $notification->data['link_text'] ?? 'View update' }}
                                            &rarr;</a>
                                    @endif
                                </div>
                            </div>

                            @unless ($notification->read_at)
                                <button title="mark as readed"
                                    onclick="mark_as_readed(event,'{{ $notification->id }}')"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                                        fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M15.4933 6.93502C15.8053 7.20743 15.8374 7.68122 15.565 7.99325L7.70786 16.9933C7.56543 17.1564 7.35943 17.25 7.14287 17.25C6.9263 17.25 6.72031 17.1564 6.57788 16.9933L3.43502 13.3933C3.16261 13.0812 3.19473 12.6074 3.50677 12.335C3.8188 12.0626 4.29259 12.0947 4.565 12.4068L7.14287 15.3596L14.435 7.00677C14.7074 6.69473 15.1812 6.66261 15.4933 6.93502Z"
                                            fill="#6b7280" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M20.5175 7.01946C20.8174 7.30513 20.829 7.77986 20.5433 8.07981L11.9716 17.0798C11.8201 17.2389 11.6065 17.3235 11.3872 17.3114C11.1679 17.2993 10.9649 17.1917 10.8318 17.0169L10.4035 16.4544C10.1526 16.1249 10.2163 15.6543 10.5458 15.4034C10.8289 15.1878 11.2161 15.2044 11.4787 15.4223L19.4571 7.04531C19.7428 6.74537 20.2175 6.73379 20.5175 7.01946Z"
                                            fill="#6b7280" />
                                    </svg></button>
                            @endunless

                        </article>
                    @endforeach
                </div>
            @else
                <div class="rounded-xl border border-dashed border-slate-300 bg-white px-6 py-14 text-center">
                    <h2 class="text-xl font-bold text-slate-900">You are all caught up</h2>
                    <p class="mt-2 text-sm text-slate-600">New course and account updates will appear here.</p>
                </div>
            @endif
        </div>
    </main>
</x-app-layout>
<script>
    function mark_as_readed(e, notify_id) {
        // let notify = notify_id
        e.preventDefault();
        fetch("{{ route('notify.mark_as_readed', ':id') }}".replace(':id', notify_id)).then((result) => {
            e.target.parentElement.parentElement.style.display = "none"
            // console.log(e.target.parentElement.parentElement);
            //  e.target.parentElement.parentElement.parentElement
            console.log(e.target.parentElement.parentElement.parentElement.childNodes());

            // if (!e.target.parentElement.parentElement.parentElement.hasChildNodes()) {
            //     let empty = document.createElement("div");
            //     empty.classList.append("m-4")
            //     empty.classList.append("text-lg")
            //     empty.classList.append("font-semibold")
            //     empty.classList.append("text-center")
            //     empty.textContent = "No unreaded Notifigation"
            //     e.target.parentElement.parentElement.parentElement.appendChild("empty")
            // }

        }).catch((err) => {

        });







    }
</script>
