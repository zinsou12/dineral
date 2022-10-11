if($filleul->niveau_id === 1)
        {
            $filleulinfo = User::find($filleul->id);
           
                $filleulinfos += ($filleulinfo->investissement*20)/100;

                $filleul->statutgain = true;

                $filleul->save();
            
        }

        if($filleul->niveau_id === 2)
        {
            $filleulinfo = User::find($filleul->id);

                $filleulinfos += ($filleulinfo->investissement*3)/100;

                $filleul->statutgain = true;

                $filleul->save();
           
        }

        if($filleul->niveau_id === 3)
        {
            $filleulinfo = User::find($filleul->id);

                $filleulinfos += ($filleulinfo->investissement*2)/100;

                $filleul->statutgain = true;

                $filleul->save();
           
        }

        if($filleul->niveau_id === 4)
        {
            $filleulinfo = User::find($filleul->id);

                $filleulinfos += ($filleulinfo->investissement*1)/100;

                $filleul->statutgain = true;

                $filleul->save();
           
        }

        if($filleul->niveau_id === 5)
        {
            $filleulinfo = User::find($filleul->id);

                $filleulinfos += ($filleulinfo->investissement*0.5)/100;

                $filleul->statutgain = true;

                $filleul->save();
            
        }

        if($filleul->niveau_id === 6)
        {
            $filleulinfo = User::find($filleul->id);

            
          
                $filleulinfos += ($filleulinfo->investissement*0.35)/100;

                
           
        }

        if($filleul->niveau_id === 7)
        {
            $filleulinfo = User::find($filleul->id);

           
                $filleulinfos += ($filleulinfo->investissement*0.25)/100;

                $filleul->statutgain = true;

                $filleul->save();
           
        }