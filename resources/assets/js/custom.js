class Utilities{
    static addMinutes(time, minsToAdd) {
        function D(J){
            return (J<10? '0':'') + J;
        };
        var piece = time.split(':');
        var mins = piece[0]*60 + +piece[1] + +minsToAdd;
        return D(mins%(24*60)/60 | 0) + ':' + D(mins%60);
    }

    static hourToMinutes(hour){
        var piece = hour.split(':');
        if (piece.length > 1) {
          return piece[0]*60 + +piece[1];
        } else {
          return 0;
        }

    }
  
    static minutesToHour(minutes){
         function D(J){
             return (J<10? '0':'') + J;
         };
         return D(minutes/60 | 0) + ':' + D(minutes%60);
    }

}
