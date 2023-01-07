<x-business-layout>
    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <div class="w-full flex gap-5 items-center mb-5">
                <h1 class="text-[26px] font-bold text-[#27272A]">Calendario Prenotazioni</h1>
            </div>

            <div id="calendar">
                {{-- Generate FullCalendar --}}
            </div>

            {{-- Modal create reservation --}}
            <div id="reservation" tabindex="-1" role="dialog" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 h-full w-full bg-black/25">
                <div class=" w-full h-full flex justify-center items-center">
                    <div class="bg-white p-5 relative w-[650px] rounded-md">
                        <h3 class=" text-xl font-bold tracking-[0.75px] uppercase text-start mb-4">Nuova Prenotazione</h3>

                        <button id="close-reservation" type="button" class="absolute top-3 right-2.5 text-white bg-gray-400 hover:bg-red rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-red-600/75" >
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>

                        <form action="{{Route('business.reservation.store')}}" method="post">
                            @csrf

                            <div class="w-full flex gap-4">
                                <div class="flex flex-col justify-start gap-4 grow">
                                    <div>
                                        <x-input-label for="user_id" :value="__('Paziente')" class="w-fit" />
                                        <select name="user_id" id="user_id" name="user_id" class="mt-1 w-full rounded-md border-gray-500/30 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                            <option disabled selected value="">Seleziona</option>
                                            @foreach ($patients as $patient )
                                                <option value="{{$patient->id}}">{{$patient->name . ' ' . $patient->last_name}}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="cabin_id" :value="__('Cabina')" class="w-fit" />
                                        <select name="cabin_id" id="cabin_id" name="cabin_id" class="mt-1 w-full rounded-md border-gray-500/30 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                            <option disabled selected value="">Seleziona</option>
                                            @foreach ($cabins as $cabin )
                                                <option value="{{$cabin->id}}">{{$cabin->name}}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('cabin_id')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="provider_id" :value="__('Servizio')" class="w-fit" />
                                        <select onchange="selectProvider()" name="provider_id" id="provider_id" name="provider_id" class="mt-1 w-full rounded-md border-gray-500/30 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                            <option disabled selected value="">Seleziona</option>
                                            @foreach ($providers as $provider )
                                                <option value="{{$provider->id}}" class="capitalize font-medium">{{$provider->name}} ({{$provider->duration}} Min)</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('provider_id')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="flex flex-col justify-start gap-4">
                                    <div>
                                        <x-input-label for="start_time" :value="__('inizio')" class="w-fit" />
                                        <x-text-input id="start_time" class="block mt-1 w-full" type="datetime-local" placeholder="01/01/2023" pattern="[0-9\./\]+" name="start_time" :value="old('start_time')" autofocus />
                                        <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="finish_time" :value="__('fine')" class="w-fit" />
                                        <x-text-input id="finish_time" class="block mt-1 w-full" type="datetime-local" placeholder="01/01/2023" pattern="[0-9\./\]+" name="finish_time" :value="old('finish_time')" autofocus />
                                        <x-input-error :messages="$errors->get('finish_time')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="note" :value="__('Note')" class="w-fit" />
                                        <textarea id="note" name="note" cols="30" rows="5" class="block mt-1 w-full rounded-md border-gray-500/30 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" :value="old('note')" autofocus />
                                        </textarea>
                                        <x-input-error :messages="$errors->get('note')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-end gap-2 mt-4">
                                <div>
                                    <button type="submit" class="border px-5 py-2 rounded-md bg-gray-800/80 text-white hover:bg-green-800/70 tracking-[1px] uppercase ">Prenota</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Modal Info reservation --}}
            <div id="modal-info" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 z-50 h-full w-[87%] bg-black/25">
                <div class="w-full h-full flex justify-center items-start">
                    <div class="bg-white flex justify-between items-end p-5 relative w-[650px] rounded-md mt-5 ">
                        <div>
                            <h3 class=" text-xl font-bold tracking-[0.75px] uppercase text-start mb-4">Prenotazione</h3>
                            <div id="modal-infoContent"></div>
                        </div>
                        <form id="delete" action="" method="post" class="flex gap-3 justify-center items-end">
                            @csrf @method('DELETE')
                            <span class="chiudi px-7 py-3 bg-[#E5EAEA] hover:bg-[#DCE2E2] text-[13px] text-[#6B7A88] font-bold uppercase  tracking-[0.75px]">
                                Chiudi
                            </span>
                            <div class="flex flex-col gap-3">
                                <button type="submit" class="conferma hidden  px-7 py-3 bg-black text-[13px] text-white font-bold uppercase tracking-[0.75px]">
                                    Conferma
                                </button>
                                <span class="delete px-7 py-3 bg-red-500 text-[13px] text-white font-bold uppercase hover:bg-red-500/80 tracking-[0.75px]">
                                    Elimina
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Close Modal reservation
            document.querySelector('#close-reservation').addEventListener('click', e => {
                document.querySelector('#reservation').classList.toggle('hidden');
            });

            // Close Modal info
            document.querySelector('.chiudi').addEventListener('click', e => {
                document.querySelector('#modal-info').classList.toggle('hidden');
                if (document.querySelector('.delete').classList.contains('hidden')) {
                    document.querySelector('.conferma').classList.add('hidden');
                    document.querySelector('.delete').classList.remove('hidden');
                }
            });

            function selectProvider() {
                // get id provider
                const provider = document.querySelector('#provider_id');
                const valueProvider = provider.options[provider.selectedIndex].value;
                let duration;

                // get provider duration from id
                let requestDuration = function() {
                    $.ajax({
                        url: "http://127.0.0.1:8000/api/provider",
                        type: "GET",
                        dataType: "json",
                        async: false,
                        success: function(data){
                            duration = data[valueProvider*1 -1].duration;
                        },
                        error: function(error){
                            console.log(error);
                        }
                    });
                    return duration;
                }();

                //Define finish
                var start = moment(document.querySelector('#start_time').value, 'YYYY-MM-DDTHH:mm');
                var finish = start.add(duration,'m').format('YYYY-MM-DDTHH:mm');
                document.querySelector('#finish_time').value = finish;
            };

            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new Calendar(calendarEl, {
                    editable: false,
                    selectable: false,
                    plugins: [ dayGridPlugin, timeGridPlugin, listPlugin, interaction ],
                    locale: 'it',
                    timeZone: 'Europe/Rome',
                    height: 750,
                    navLinks: true,
                    initialView: 'timeGridDay',
                    slotMinTime: '8:00:00',
                    slotMaxTime: '20:00:00',
                    nowIndicator: true,
                    slotEventOverlap: false,
                    dayHeaderFormat: { weekday: 'long'},
                    slotDuration: '00:10:00',
                    slotLabelInterval: '00:10:00',
                    dayMaxEventRows: true,
                    eventMaxStack: true,
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                    },
                    buttonText: {
                        today:    'Oggi',
                        month:    'Mese',
                        week:     'Settimana',
                        day:      'giorno',
                        list:     'Agenda'
                    },
                    businessHours: {
                        daysOfWeek: [ 1, 2, 3, 4, 5, 6 ],
                        startTime: '8:00',
                        endTime: '20:00',
                    },
                    views: {
                        dayGridMonth: {
                            dayMaxEventRows: 5,
                            titleFormat: { month: 'long', year: 'numeric' },
                        },
                        timeGridDay: {
                            titleFormat: { day: 'numeric', month: 'long', year: 'numeric' },
                            eventMaxStack: 10,

                            // funtion open modal Reservation, set start, verify free collaborator
                            dateClick: function(date) {
                                var i = date.date;
                                document.querySelector('#start_time').value = i.toISOString().slice(0,16);

                                var all_events = calendar.getEvents();
                                var current = [];
                                var slot = [];
                                var col = @json($collaborators);
                                var start = moment(date.dateStr, 'YYYY-MM-DDTHH:mm');
                                var minute = 0;
                                var minuteRestant = 0;

                                all_events.forEach(function(event) {

                                    if (event.startStr <= date.dateStr && event.endStr > date.dateStr) {
                                        current.push(event)
                                    }

                                    if (date.dateStr < event.startStr) {

                                        while (slot.length < col) {

                                            all_events.forEach(function(event) {
                                                //check reservation to slot Time
                                                if (moment(event.startStr, 'YYYY-MM-DDTHH:mm').format('YYYY-MM-DDTHH:mm') <= start.format('YYYY-MM-DDTHH:mm') && moment(event.endStr, 'YYYY-MM-DDTHH:mm').format('YYYY-MM-DDTHH:mm') > start.format('YYYY-MM-DDTHH:mm')) {
                                                    // check if contain reservation
                                                    if (!slot.includes(event.id)) {
                                                        // insert to array
                                                        slot.push(event.id);
                                                        console.log('push: ' + moment(event.startStr, 'YYYY-MM-DDTHH:mm').format('HH:mm'), ' | evento numero: ' + event.id);
                                                    }
                                                }
                                            });

                                            // add 10 minutes to variable minute
                                            if (slot.length < col) {
                                                minute = minute += 10;
                                            }
                                            // add 10 minute for check next slot Time
                                            start.add(10,'m').format('HH:mm');
                                        }
                                    }
                                });

                                console.log('prenotazioni: ' + slot.length, ' | minuti disponibili: ' + minute);

                                // console.log(@json($providers)[0].duration);
                                if (current.length >= col ) {
                                    alert('Le prenotazioni per questo orario sono piene!');
                                } else {
                                     document.querySelector('#reservation').classList.toggle('hidden');
                                }

                            },
                            eventContent: function(event) {
                                var main =
                                    '• ' +event.event.title + ' ' +
                                    event.event.extendedProps.provider
                                ;

                                return main;
                            },
                        },
                        timeGridWeek: {
                            titleFormat: { day: 'numeric', month: 'long', year: 'numeric' },
                            eventMaxStack: 2,
                        },
                        list: {
                            eventContent: function(event) {
                                var main =
                                    'Paziente: ' + event.event.title + ' — ' +
                                    'Trattamento: ' + event.event.extendedProps.provider
                                ;

                                return main;
                            },

                        }
                    },

                    // function open modal Info in to all views
                    eventClick: function(event) {
                        //set date
                        function formatDate(date) {
                            var hours = (date.getHours() - 1) ;
                            var minutes = date.getMinutes();
                            var ampm = hours >= 12 ? 'PM' : 'AM';
                            hours = hours % 12;
                            hours = hours ? hours : 12;
                            minutes = minutes < 10 ? '0'+ minutes : minutes;
                            var strTime = hours + ':' + minutes + ' ' + ampm;
                            return date.getDate() + "/" + (date.getMonth()+1) + "/" + date.getFullYear() + " ore " + strTime;
                        }

                        document.querySelector('#modal-info').classList.toggle('hidden');
                        document.querySelector('#modal-infoContent').innerHTML =
                            '<b>Cliente: </b>' + event.event.title + '<br>' +
                            '<b>Cabina: </b>' + event.event.extendedProps.cabin  + '<br>' +
                            '<b>Trattamento: </b>' + event.event.extendedProps.provider + '<br>'  +
                            '<b>Inizio: </b>' + formatDate(event.event.start) + '<br>' +
                            '<b>Fine: </b>' + formatDate(event.event.end)
                        ;

                        // delete event
                        $('.delete').click(function() {
                            document.querySelector('.delete').classList.add('hidden');
                            document.querySelector('.conferma').classList.remove('hidden');

                            $('.conferma').click(function() {
                                var id = event.event.id;
                                const form = document.querySelector('#delete');

                                form.setAttribute("action", "{{ route('business.reservation.destroy', '') }}" +'/'+ id);
                                document.querySelector('#modal-info').classList.toggle('hidden');
                                document.querySelector('.delete').classList.add('hidden');
                            });
                        })
                    },

                    events: @json($events),
                });

                calendar.render();
            });
        </script>
    @endpush
</x-business-layout>
