<x-business-layout>
    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <div>
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-5">
                        @if ($user->image_profile)
                            <img class="w-[120px] mb-5" src="{{asset('storage/' . $user->image_profile)}}" alt="">
                        @endif
                        <h1 class="text-3xl font-semibold mb-5">{{$user->name . ' ' . $user->last_name}}</h1>
                    </div>
                    <a href="{{url()->previous()}}" class="border-[2px] border-gray-800/80 px-5 py-2 rounded-md bg-gray-800/80 text-white hover:bg-transparent hover:text-black tracking-[0.75px]">Indietro</a>
                </div>
            </div>

            <div class="w-full bg-white shadow-lg p-5 flex">
                <div class="flex flex-col gap-2 w-full">
                    <div class="flex gap-2 w-full">
                        <div class="flex flex-col gap-2 border p-5 grow shadow-md">
                            <h3 class="uppercase font-semibold text-xl">dati anagrafici</h3>
                            <span><strong>Cliente Straniero:</strong> {{$user->foreigner == 1 ? 'Si' : 'No'}}</span>
                            <span><strong>Codice Fiscale:</strong> {{$user->cf}}</span>
                            <span><strong>Data di nascita:</strong> {{ date("d-m-Y", strtotime($user->date_of_birth)) }}</span>
                            <span><strong>Luogo di nascita:</strong> {{ $user->birth_place }}</span>
                            <span><strong>Provincia:</strong> {{ $user->country_of_birth }}</span>
                            <span><strong>Sesso:</strong> {{ $user->sex == 1 ? 'F' : 'M' }}</span>
                            <span><strong>Altezza:</strong> {{ $user->height }} Cm.</span>
                            <span><strong>Professione:</strong> {{ $user->profession }}</span>
                            <span><strong>Ragione sociale:</strong> {{ $user->business_name }}</span>
                            <span><strong>P.IVA:</strong> {{ $user->p_iva }}</span>
                        </div>

                        <div class="flex flex-col gap-2 border p-5 grow shadow-md">
                            <h3 class="uppercase font-semibold text-xl">recapiti</h3>
                            <span><strong>Cellulare:</strong> {{ $user->mobile_phone }}</span>
                            <span><strong>Telefono:</strong> {{ $user->telephone }}</span>
                            <span><strong>Email:</strong> {{ $user->email }}</span>
                            <span><strong>Indirizzo:</strong> {{ $user->address }}</span>
                            <span><strong>Civico:</strong> {{ $user->civic }}</span>
                            <span><strong>Citta:</strong> {{ $user->city }}</span>
                            <span><strong>Provincia:</strong> {{ $user->province }}</span>
                            <span><strong>Cap:</strong> {{ $user->cap }}</span>
                        </div>

                        <div class="flex flex-col gap-2 border p-5 grow shadow-md">
                            <h3 class="uppercase font-semibold text-xl">stato generale di salute</h3>
                            <span><strong>Allergie:</strong>@if($user->allergies) {{$user->allergies}} @else Nessuna @endif</span>
                            <span><strong>Interventi recenti:</strong>@if($user->interventions) {{$user->interventions}} @else Nessuno @endif</span>
                            <span><strong>Patologie:</strong>@if($user->patologys) {{$user->patologys}} @else Nessuna @endif</span>
                            <span><strong>Farmaci in assunzione:</strong>@if($user->medications) {{$user->medications}} @else Nessuno @endif</span>
                            <span><strong>Disturbi generali minori:</strong>@if($user->disturbance) {{$user->disturbance}} @else Nessuno @endif</span>
                            <span><strong>Artrosi e ospeoporosi:</strong> {{ $user->artrosi == 1 ? 'Si' : 'No' }}</span>
                            <span><strong>Vaccinato COVID:</strong> {{ $user->covid_vaccine == 1 ? 'Si' : 'No' }}</span>
                        </div>

                        <div class="flex flex-col gap-2 border p-5 grow shadow-md">
                            <h3 class="uppercase font-semibold text-xl">Stile di vita</h3>
                            <span><strong>Sport:</strong> {{ $user->sport == 1 ? 'Si' : 'No' }}</span>
                            <span><strong>Diuresi:</strong> {{ $user->diuresi }}</span>
                            <span><strong>Qta. (l/gg):</strong> {{ $user->diuresi_qta }}</span>
                            <span><strong>Menopausa:</strong> {{ $user->menopause == 1 ? 'Si' : 'No' }}</span>
                            <span><strong>Ciclo irregolare:</strong> {{ $user->cicle == 1 ? 'Si' : 'No' }}</span>
                            <span><strong>Ass. anticoncezionali:</strong> {{ $user->contraceptive == 1 ? 'Si' : 'No' }}</span>
                            <span><strong>Fumatrice:</strong> {{ $user->smoker == 1 ? 'Si' : 'No' }}</span>
                            <span><strong>Stato di gravidanza (Mesi):</strong>@if($user->pregnancy) {{$user->pregnancy}} @else Nessuna @endif</span>
                            <span><strong>Cellulite:</strong> {{ $user->cellulite }}</span>
                            <span><strong>Intestino:</strong> {{ $user->intestine }}</span>
                        </div>
                    </div>

                    <div class="flex gap-2 w-full">
                        <div class="flex flex-col gap-2 border p-5 grow shadow-md">
                            <h3 class="uppercase font-semibold text-xl">Alimentazione</h3>
                            <span><strong>Tipo alimentazione:</strong> {{ $user->alimentation == 1 ? 'Regolare' : 'Irregolare' }}</span>
                            <p><strong>Note:</strong> @if($user->alimentation_note) {{$user->alimentation_note}} @else Nessuna @endif</p>
                            <span><strong>Segue piano alimentare:</strong> {{ $user->alimentation_follow == 1 ? 'Si' : 'No' }}</span>
                            <span><strong>Da quando:</strong> {{ $user->alimentation_since }}</span>
                            <span><strong>Assunzione drenanti:</strong>@if($user->drenant) {{$user->drenant}} @else Nessuno @endif</span>
                            <span><strong>Assunzione integratori:</strong>@if($user->integration) {{$user->integration}} @else Nessuno @endif</span>
                        </div>

                        <div class="flex flex-col gap-2 border p-5 grow shadow-md">
                            <h3 class="uppercase font-semibold text-xl">Estetica</h3>
                            <span><strong>Tipo di estetica:</strong> {{ $user->aesthetics == 1 ? 'Base' : 'Avanzata' }}</span>
                            <span><strong>Adipe:</strong> {{ $user->adipe == 1 ? 'Si' : 'No' }}</span>
                            <span><strong>Rilassamento cutaneo:</strong> {{ $user->skin_relax == 1 ? 'Si' : 'No' }}</span>
                            <span><strong>Teleangectasia:</strong> {{ $user->teleangectasia == 1 ? 'Si' : 'No' }}</span>
                            <span><strong>Crema corpo:</strong>@if($user->body_cream) {{$user->body_cream}} @else Nessuna @endif </span>
                            <span><strong>Crema Viso:</strong>@if($user->face_cream) {{$user->face_cream}} @else Nessuna @endif </span>
                        </div>

                        <div class="flex flex-col gap-2 border p-5 grow shadow-md">
                            <h3 class="uppercase font-semibold text-xl">pelle</h3>
                            <span><strong>Fototipo:</strong> {{ $user->skin}}</span>
                            <div>
                                <strong>Tipo di pelle:</strong>
                                @if ($types)
                                    @foreach ($types as $type)
                                        <span class="capitalize">
                                            {{$type}},
                                        </span>
                                    @endforeach
                                @endif
                            </div>
                            <span><strong>Inestetesmi viso:</strong>@if($user->skin_blemishes) {{$user->skin_blemishes}} @else Nessuna @endif </span>
                            <span><strong>Inestetismi corpo:</strong>@if($user->body_blemishes) {{$user->body_blemishes}} @else Nessuna @endif </span>
                            <span><strong>Esp. Lampade solari:</strong> {{ $user->solar_lamp == 1 ? 'Si' : 'No' }}</span>
                        </div>

                        <div class="flex flex-col gap-2 border p-5 grow shadow-md">
                            <h3 class="uppercase font-semibold text-xl">Altro</h3>
                            <span><strong>Come ci ha conosciuto:</strong> {{ $user->knows}}</span>
                            <span><strong>Note:</strong>@if($user->note) {{$user->note}} @else Nessuna @endif</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-business-layout>
