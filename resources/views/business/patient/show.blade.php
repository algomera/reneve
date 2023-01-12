<x-business-layout>
    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <div>
                <div class="w-full flex justify-start items-end gap-5">
                    @if ($user->image_profile)
                        <img class="w-[120px] mb-5" src="{{asset('storage/' . $user->image_profile)}}" alt="">
                    @endif
                    <h1 class="text-[26px] font-bold mb-5">{{$user->name . ' ' . $user->last_name}}</h1>
                </div>
            </div>

            <div class="flex gap-5 mt-5">
                <div class="w-1/2 bg-white shadow-lg p-5">
                    <h3 class="text-[20px] font-bold mb-5">Storico prenotazioni</h3>
                    <div>
                        @if (sizeof($reservations) > 0)
                            @foreach ($reservations as $reservation)
                                <table class="w-full border-2">
                                    <thead>
                                        <tr class="uppercase border-b-2  h-[35px]">
                                            <th class="border-l-2">tipo</th>
                                            <th class="border-l-2">trattamento</th>
                                            <th class="border-l-2">cabina</th>
                                            <th class="border-l-2">data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center border capitalize font-medium text-[#27272A] h-[35px]">
                                            <td class="border-l">{{$reservation->provider->type}}</td>
                                            <td class="border-l">{{$reservation->provider->name}}</td>
                                            <td class="border-l">{{$reservation->cabin->name}}</td>
                                            <td class="border-l">{{date("d/m/Y - h:m", strtotime($reservation->created_at))}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endforeach
                        @else
                            <h3 class="text-[20px] font-bold mb-5">Nessuna prenotazione presente!</h3>
                        @endif
                    </div>
                </div>

                <div class="w-1/2 flex">
                    <div class="flex flex-col gap-2 w-full">
                        <div class="flex flex-wrap gap-2 w-full">
                            {{-- Dati Anagrafici --}}
                            <div class="bg-white flex flex-col gap-2 border p-5 max-w-[50%] grow shadow-md">
                                <h3 class="text-[20px] font-bold capitalize text-[#27272A]">dati anagrafici</h3>
                                <span><strong class="text-[15px]">Cliente Straniero:</strong> {{$user->foreigner == 1 ? 'Si' : 'No'}}</span>
                                <span class="uppercase"><strong class="text-[15px] capitalize">Codice Fiscale:</strong> {{$user->cf}}</span>
                                <span><strong class="text-[15px]">Data di nascita:</strong> {{ date("d-m-Y", strtotime($user->date_of_birth)) }}</span>
                                <span><strong class="text-[15px]">Luogo di nascita:</strong> {{ $user->birth_place }}</span>
                                <span><strong class="text-[15px]">Provincia:</strong> {{ $user->country_of_birth }}</span>
                                <span><strong class="text-[15px]">Sesso:</strong> {{ $user->sex == 1 ? 'F' : 'M' }}</span>
                                <span><strong class="text-[15px]">Altezza:</strong> {{ $user->height }} Cm.</span>
                                <span><strong class="text-[15px]">Professione:</strong> {{ $user->profession }}</span>
                                <span><strong class="text-[15px]">Ragione sociale:</strong> {{ $user->business_name }}</span>
                                <span><strong class="text-[15px]">P.iva:</strong> {{ $user->p_iva }}</span>
                            </div>
                            {{-- Recapiti --}}
                            <div class="bg-white flex flex-col gap-2 border p-5 max-w-[50%] grow shadow-md">
                                <h3 class="text-[20px] font-bold capitalize text-[#27272A]">recapiti</h3>
                                <span><strong class="text-[15px]">Cellulare:</strong> {{ $user->mobile_phone }}</span>
                                <span><strong class="text-[15px]">Telefono:</strong> {{ $user->telephone }}</span>
                                <span><strong class="text-[15px]">Email:</strong> {{ $user->email }}</span>
                                <span><strong class="text-[15px]">Indirizzo:</strong> {{ $user->address }}</span>
                                <span><strong class="text-[15px]">Civico:</strong> {{ $user->civic }}</span>
                                <span><strong class="text-[15px]">Citta:</strong> {{ $user->city }}</span>
                                <span><strong class="text-[15px]">Provincia:</strong> {{ $user->province }}</span>
                                <span><strong class="text-[15px]">Cap:</strong> {{ $user->cap }}</span>
                            </div>
                            {{-- Stato generale di salute --}}
                            <div class="bg-white flex flex-col gap-2 border p-5 max-w-[50%] grow shadow-md">
                                <h3 class="text-[20px] font-bold capitalize text-[#27272A]">stato generale di salute</h3>
                                <span><strong class="text-[15px]">Allergie:</strong>@if($user->allergies) {{$user->allergies}} @else Nessuna @endif</span>
                                <span><strong class="text-[15px]">Interventi recenti:</strong>@if($user->interventions) {{$user->interventions}} @else Nessuno @endif</span>
                                <span><strong class="text-[15px]">Patologie:</strong>@if($user->patologys) {{$user->patologys}} @else Nessuna @endif</span>
                                <span><strong class="text-[15px]">Farmaci in assunzione:</strong>@if($user->medications) {{$user->medications}} @else Nessuno @endif</span>
                                <span><strong class="text-[15px]">Disturbi generali minori:</strong>@if($user->disturbance) {{$user->disturbance}} @else Nessuno @endif</span>
                                <span><strong class="text-[15px]">Artrosi e ospeoporosi:</strong> {{ $user->artrosi == 1 ? 'Si' : 'No' }}</span>
                                <span><strong class="text-[15px]">Vaccinato COVID:</strong> {{ $user->covid_vaccine == 1 ? 'Si' : 'No' }}</span>
                            </div>
                            {{-- Stile di vita --}}
                            <div class="bg-white flex flex-col gap-2 border p-5 max-w-[50%] grow shadow-md">
                                <h3 class="text-[20px] font-bold capitalize text-[#27272A]">Stile di vita</h3>
                                <span><strong class="text-[15px]">Sport:</strong> {{ $user->sport == 1 ? 'Si' : 'No' }}</span>
                                <span><strong class="text-[15px]">Diuresi:</strong> {{ $user->diuresi }}</span>
                                <span><strong class="text-[15px]">Qta. (l/gg):</strong> {{ $user->diuresi_qta }}</span>
                                <span><strong class="text-[15px]">Menopausa:</strong> {{ $user->menopause == 1 ? 'Si' : 'No' }}</span>
                                <span><strong class="text-[15px]">Ciclo irregolare:</strong> {{ $user->cicle == 1 ? 'Si' : 'No' }}</span>
                                <span><strong class="text-[15px]">Ass. anticoncezionali:</strong> {{ $user->contraceptive == 1 ? 'Si' : 'No' }}</span>
                                <span><strong class="text-[15px]">Fumatrice:</strong> {{ $user->smoker == 1 ? 'Si' : 'No' }}</span>
                                <span><strong class="text-[15px]">Stato di gravidanza (Mesi):</strong>@if($user->pregnancy) {{$user->pregnancy}} @else Nessuna @endif</span>
                                <span><strong class="text-[15px]">Cellulite:</strong> {{ $user->cellulite }}</span>
                                <span><strong class="text-[15px]">Intestino:</strong> {{ $user->intestine }}</span>
                            </div>
                            {{-- Alimentazione --}}
                            <div class="bg-white flex flex-col gap-2 border p-5 max-w-[50%] grow shadow-md">
                                <h3 class="text-[20px] font-bold capitalize text-[#27272A]">Alimentazione</h3>
                                <span><strong class="text-[15px]">Tipo alimentazione:</strong> {{ $user->alimentation == 1 ? 'Regolare' : 'Irregolare' }}</span>
                                <p><strong class="text-[15px]">Note:</strong> @if($user->alimentation_note) {{$user->alimentation_note}} @else Nessuna @endif</p>
                                <span><strong class="text-[15px]">Segue piano alimentare:</strong> {{ $user->alimentation_follow == 1 ? 'Si' : 'No' }}</span>
                                <span><strong class="text-[15px]">Da quando:</strong> {{ $user->alimentation_since }}</span>
                                <span><strong class="text-[15px]">Assunzione drenanti:</strong>@if($user->drenant) {{$user->drenant}} @else Nessuno @endif</span>
                                <span><strong class="text-[15px]">Assunzione integratori:</strong>@if($user->integration) {{$user->integration}} @else Nessuno @endif</span>
                            </div>
                            {{-- Estetica --}}
                            <div class="bg-white flex flex-col gap-2 border p-5 max-w-[50%] grow shadow-md">
                                <h3 class="text-[20px] font-bold capitalize text-[#27272A]">Estetica</h3>
                                <span><strong class="text-[15px]">Tipo di estetica:</strong> {{ $user->aesthetics == 1 ? 'Base' : 'Avanzata' }}</span>
                                <span><strong class="text-[15px]">Adipe:</strong> {{ $user->adipe == 1 ? 'Si' : 'No' }}</span>
                                <span><strong class="text-[15px]">Rilassamento cutaneo:</strong> {{ $user->skin_relax == 1 ? 'Si' : 'No' }}</span>
                                <span><strong class="text-[15px]">Teleangectasia:</strong> {{ $user->teleangectasia == 1 ? 'Si' : 'No' }}</span>
                                <span><strong class="text-[15px]">Crema corpo:</strong>@if($user->body_cream) {{$user->body_cream}} @else Nessuna @endif </span>
                                <span><strong class="text-[15px]">Crema Viso:</strong>@if($user->face_cream) {{$user->face_cream}} @else Nessuna @endif </span>
                            </div>
                            {{-- Pelle --}}
                            <div class="bg-white flex flex-col gap-2 border p-5 max-w-[50%] grow shadow-md">
                                <h3 class="text-[20px] font-bold capitalize text-[#27272A]">pelle</h3>
                                <span><strong class="text-[15px]">Fototipo:</strong> {{ $user->skin}}</span>
                                <div>
                                    <strong class="text-[15px]">Tipo di pelle:</strong>
                                    @if ($types)
                                        @foreach ($types as $type)
                                            <span class="capitalize">
                                                {{$type}},
                                            </span>
                                        @endforeach
                                    @endif
                                </div>
                                <span><strong class="text-[15px]">Inestetesmi viso:</strong>@if($user->skin_blemishes) {{$user->skin_blemishes}} @else Nessuna @endif </span>
                                <span><strong class="text-[15px]">Inestetismi corpo:</strong>@if($user->body_blemishes) {{$user->body_blemishes}} @else Nessuna @endif </span>
                                <span><strong class="text-[15px]">Esp. Lampade solari:</strong> {{ $user->solar_lamp == 1 ? 'Si' : 'No' }}</span>
                            </div>
                            {{-- Altro --}}
                            <div class="bg-white flex flex-col gap-2 border p-5 max-w-[50%] grow shadow-md">
                                <h3 class="text-[20px] font-bold capitalize text-[#27272A]">Altro</h3>
                                <span><strong class="text-[15px]">Come ci ha conosciuto:</strong> {{ $user->knows}}</span>
                                <span><strong class="text-[15px]">Note:</strong>@if($user->note) {{$user->note}} @else Nessuna @endif</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-business-layout>
