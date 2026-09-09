<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
   public function room()
   {
      return view('Backend.Room');
   }

   public function roomcode(Request $request)
   {
      $request->validate([
         'room_number' => 'required',
         'price'       => 'required',
         'type'        => 'required',
         'status'      => 'required',
         'description' => 'required',
      ]);

      Room::create([
         'room_number' => $request->room_number,
         'price'       => $request->price,
         'type'        => $request->type,
         'status'      => $request->status,
         'description' => $request->description,
      ]);

      return redirect('roomshow')->with('success', 'Room added successfully!');
   }

   public function roomshow(Request $request)
   {
      $data = Room::latest()->paginate(5);
      return view('Backend.Roomshow', compact('data'));
   }

   public function roomedit(Request $request, $id)
   {
      $data = Room::find($id);
      return view('Backend.Roomedit', compact('data'));
   }

   public function roomupdate(Request $request, $id)
   {
      $data = Room::findOrFail($id);
      $data->room_number = $request->room_number;
      $data->price = $request->price;
      $data->type = $request->type;
      $data->status = $request->status;
      $data->description = $request->description;
      $data->save();
      return redirect('roomshow')->with('success', 'Room updated successfully!');
   }

   public function roomdelete($id)
   {
      $data = Room::find($id);
      if ($data) {
         $data->delete();
      }
      return redirect('roomshow')->with('success', 'Room deleted successfully!');
   }
}
