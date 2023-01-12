<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    private function getUserButtons(User $user) {
        $id = $user->id;

        $buttonShow =
            '<a href="'.route('business.patient.show', $id).'" title="view" id="show-'.$id.'" class="grow flex justify-center w-[36px] h-[30px] hover:bg-[#27272A] items-center rounded-md bg-[#1EC981] group">
                <img src="'. asset('images/eyeglasses.svg') .'" alt="" class="scale-[1.2]">
            </a>';

        $buttonEdit =
            '<a href="'.route('business.patient.edit', $id).'" title="update" id="edit-'.$id.'" class="grow flex justify-center w-[36px] h-[30px] hover:bg-[#27272A] items-center rounded-md bg-[#ABB1B1] group">
                <img src="'. asset('images/pensil.svg') .'" alt="" class="scale-[1.2]">
            </a>';

        $buttonDelete =
            '<button type="button" href="'.route('business.patient.destroy', $id).'" title="delete" class="ajax grow flex justify-center w-[36px] h-[30px] hover:bg-[#27272A] items-center rounded-md bg-[#EF5353] group">
                <img src="'. asset('images/delete.svg') .'" alt="" class="scale-[1.2]">
            </button>';

        return $buttonShow.$buttonEdit.$buttonDelete;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $business = auth()->user()->business->first();
        if ($request->ajax()) {
            $data = $business->user()->whereRole('patient')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return
                    '<div class="flex justify-center items-center gap-3">
                        '.$this->getUserButtons($data).'
                    </div>';
                })->editColumn('name', function($data){
                    return $data->name . ' ' . $data->last_name;
                })->editColumn('date_of_birth', function($data){
                    if ($data->date_of_birth) {
                        return date("d-m-Y", strtotime($data->date_of_birth));
                    }
                })->rawColumns(['action'])->make(true);
        }

        return view('business.patient.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $skin_type = ['grassa', 'secca', 'alipidica', 'mista', 'sensibile', 'acneica', 'couperose', 'rugosa', 'discromia', 'asfittica'];
        return view('business.patient.create', compact('skin_type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'role' => ['required'],
            'name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'foreigner' => ['nullable', 'boolean'],
            'image_profile' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg'],
            'cf' => ['nullable', 'regex:/^[A-Za-z]{6}[0-9]{2}[A-Za-z]{1}[0-9]{2}[A-Za-z]{1}[0-9]{3}[A-Za-z]{1}$/'],
            'date_of_birth' => ['nullable', 'string'],
            'birth_place' => ['nullable', 'string'],
            'country_of_birth' => ['nullable', 'string'],
            'sex' => ['nullable', 'boolean'],
            'height' => ['nullable', 'numeric'],
            'profession' => ['nullable', 'string'],
            'business_name' => ['nullable', 'string'],
            'p_iva' => ['nullable', 'numeric', 'regex:/^[0-9]{11}$/'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'mobile_phone' => ['required', 'string', 'regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/'],
            'telephone' => ['nullable', 'string', 'regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'address' => ['nullable', 'string'],
            'civic' => ['nullable', 'numeric'],
            'city' => ['nullable', 'string'],
            'province' => ['nullable', 'string'],
            'cap' => ['nullable', 'numeric'],
            'allergies' => ['nullable', 'string'],
            'interventions' => ['nullable', 'string'],
            'patologys' => ['nullable', 'string'],
            'medications' => ['nullable', 'string'],
            'disturbance' => ['nullable', 'string'],
            'artrosi' => ['nullable', 'boolean'],
            'placche' => ['nullable', 'string'],
            'diseases' => ['nullable', 'string'],
            'covid_vaccine' => ['nullable', 'boolean'],
            'sport' => ['nullable', 'boolean'],
            'diuresi' => ['nullable', 'string'],
            'diuresi_qta' => ['nullable', 'numeric'],
            'menopause' => ['nullable', 'boolean'],
            'cicle' => ['nullable', 'boolean'],
            'contraceptive' => ['nullable', 'boolean'],
            'smoker' => ['nullable', 'boolean'],
            'pregnancy' => ['nullable', 'numeric'],
            'cellulite' => ['nullable', 'string'],
            'intestine' => ['nullable', 'string'],
            'knows' => ['nullable', 'string'],
            'note' => ['nullable', 'string'],
            'alimentation' => ['nullable', 'boolean'],
            'alimentation_note' => ['nullable', 'string'],
            'alimentation_follow' => ['nullable', 'boolean'],
            'alimentation_since' => ['nullable', 'string'],
            'drenant' => ['nullable', 'string'],
            'integration' => ['nullable', 'string'],
            'aesthetics' => ['nullable', 'boolean'],
            'adipe' => ['nullable', 'boolean'],
            'skin_relax' => ['nullable', 'boolean'],
            'teleangectasia' => ['nullable', 'boolean'],
            'body_cream' => ['nullable', 'string'],
            'face_cream' => ['nullable', 'string'],
            'skin' => ['nullable', 'string'],
            'skin_type' => ['nullable'],
            'skin_blemishes' => ['nullable', 'string'],
            'body_blemishes' => ['nullable', 'string'],
            'solar_lamp' => ['nullable', 'boolean'],
        ]);

        $validated['foreigner'] = $request->boolean('foreigner');
        $validated['adipe'] = $request->boolean('adipe');
        $validated['skin_relax'] = $request->boolean('skin_relax');
        $validated['teleangectasia'] = $request->boolean('teleangectasia');
        $validated['skin_type'] = $request->skin_type;
        if ($validated['skin_type']) {
            $validated['skin_type'] = json_encode($validated['skin_type']);
        }

        $comb = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $combLen = strlen($comb) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $combLen);
            $pass[] = $comb[$n];
        }
        $validated['password'] = implode($pass);

        $patient = User::create($validated);

        $business = auth()->user()->business->first();
        if (array_key_exists('image_profile', $validated)) {
            $file_path = Storage::disk('public')->put('business-'. $business->id . '/' . 'Patients' . '/' . 'patient-' . $patient->id . '/' . 'image_profile', $validated['image_profile']);
            $validated['image_profile'] = $file_path;
            $patient->update($validated);
        }

        $patient->business()->attach($business);

        return redirect()->route('business.patient.index')->with('message', "Paziente $patient->name $patient->last_name registrato!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        $types = json_decode($user->skin_type);

        $reservations = Reservation::whereUserId($id)->with('provider', 'cabin')->get();
        // dd($reservations);
        return view('business.patient.show', compact('user', 'types', 'reservations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $skin_type = ['grassa', 'secca', 'alipidica', 'mista', 'sensibile', 'acneica', 'couperose', 'rugosa', 'discromia', 'asfittica'];
        $type = [];
        if ($user->skin_type) {
            $type = json_decode($user->skin_type);
        }

        return view('business.patient.edit', compact('user', 'skin_type', 'type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'foreigner' => ['nullable', 'boolean'],
            'image_profile' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg'],
            'cf' => ['nullable', 'regex:/^[A-Za-z]{6}[0-9]{2}[A-Za-z]{1}[0-9]{2}[A-Za-z]{1}[0-9]{3}[A-Za-z]{1}$/'],
            'date_of_birth' => ['nullable', 'string'],
            'birth_place' => ['nullable', 'string'],
            'country_of_birth' => ['nullable', 'string'],
            'sex' => ['nullable', 'boolean'],
            'height' => ['nullable', 'numeric'],
            'profession' => ['nullable', 'string'],
            'business_name' => ['nullable', 'string'],
            'p_iva' => ['nullable', 'numeric', 'regex:/^[0-9]{11}$/'],
            'mobile_phone' => ['required', 'string', 'regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/'],
            'telephone' => ['nullable', 'string', 'regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/'],
            'email' => ['required', 'string', 'email', 'unique:users,email,'.$user->id],
            'address' => ['nullable', 'string'],
            'civic' => ['nullable', 'numeric'],
            'city' => ['nullable', 'string'],
            'province' => ['nullable', 'string'],
            'cap' => ['nullable', 'numeric'],
            'allergies' => ['nullable', 'string'],
            'interventions' => ['nullable', 'string'],
            'patologys' => ['nullable', 'string'],
            'medications' => ['nullable', 'string'],
            'disturbance' => ['nullable', 'string'],
            'artrosi' => ['nullable', 'boolean'],
            'placche' => ['nullable', 'string'],
            'diseases' => ['nullable', 'string'],
            'covid_vaccine' => ['nullable', 'boolean'],
            'sport' => ['nullable', 'boolean'],
            'diuresi' => ['nullable', 'string'],
            'diuresi_qta' => ['nullable', 'numeric'],
            'menopause' => ['nullable', 'boolean'],
            'cicle' => ['nullable', 'boolean'],
            'contraceptive' => ['nullable', 'boolean'],
            'smoker' => ['nullable', 'boolean'],
            'pregnancy' => ['nullable', 'numeric'],
            'cellulite' => ['nullable', 'string'],
            'intestine' => ['nullable', 'string'],
            'knows' => ['nullable', 'string'],
            'note' => ['nullable', 'string'],
            'alimentation' => ['nullable', 'boolean'],
            'alimentation_note' => ['nullable', 'string'],
            'alimentation_follow' => ['nullable', 'boolean'],
            'alimentation_since' => ['nullable', 'string'],
            'drenant' => ['nullable', 'string'],
            'integration' => ['nullable', 'string'],
            'aesthetics' => ['nullable', 'boolean'],
            'adipe' => ['nullable', 'boolean'],
            'skin_relax' => ['nullable', 'boolean'],
            'teleangectasia' => ['nullable', 'boolean'],
            'body_cream' => ['nullable', 'string'],
            'face_cream' => ['nullable', 'string'],
            'skin' => ['nullable', 'string'],
            'skin_type' => ['nullable'],
            'skin_blemishes' => ['nullable', 'string'],
            'body_blemishes' => ['nullable', 'string'],
            'solar_lamp' => ['nullable', 'boolean'],
        ]);

        $validated['foreigner'] = $request->boolean('foreigner');
        $validated['adipe'] = $request->boolean('adipe');
        $validated['skin_relax'] = $request->boolean('skin_relax');
        $validated['teleangectasia'] = $request->boolean('teleangectasia');
        $validated['skin_type'] = $request->skin_type;
        if ($validated['skin_type']) {
            $validated['skin_type'] = json_encode($validated['skin_type']);
        }

        $business = auth()->user()->business->first();
        if ($request->hasFile('image_profile')) {
            if ($user->image_profile) {
                Storage::disk('public')->delete($user->image_profile);
            }
            $file_path = Storage::disk('public')->put('business-'. $business->id . '/' . 'Patients' . '/' . 'patient-' . $user->id . '/' . 'image_profile', $validated['image_profile']);
            $validated['image_profile'] = $file_path;
        }

        $user->update($validated);

        return redirect()->route('business.patient.index')->with('message', "Paziente $user->name $user->last_name aggiornato!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = User::find($id);
        $patient->delete();

        return redirect()->back()->with('message', "Paziente $patient->last_name $patient->name eliminato!");
    }
}
