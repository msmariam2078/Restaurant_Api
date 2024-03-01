<?php
public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pair_uuid' => ['required', 'string', 'exists:pairs,uuid'],
        ]);

        if ($validator->fails()) {
            return $this->requiredField($validator->errors()->first());
        }

        $user = auth('sanctum')->user();
        $pairUUID = $request->input('pair_uuid');

        try {
            $favorite = Favorite::where('user_id', $user->id)->first();
            $currentPairs = [];

            if ($favorite) {
                $currentPairs = json_decode($favorite->pair_favorite, true) ?? [];
            }

            // Check if the pair_uuid already exists in the current pairs
            $existingPair = array_filter($currentPairs, function ($pair) use ($pairUUID) {
                return $pair['pair_uuid'] === $pairUUID;
            });

            if (empty($existingPair)) {
                // If the pair_uuid doesn't exist, add it to the current pairs
                $currentPairs[] = ['pair_uuid' => $pairUUID];
            }

            if (!$favorite) {
                $uuid = Str::uuid();

                $newFavorite = new Favorite();
                $newFavorite->uuid = $uuid;
                $newFavorite->user_id = $user->id;
                $favorite = $newFavorite;
            }

            $favorite->pair_favorite = json_encode($currentPairs);
            $favorite->save();

            $data['message'] = 'Pair added to Favorite successfully';
            return $this->apiResponse($data, true, null, 200);
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
            ?>