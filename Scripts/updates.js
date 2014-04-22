//Updates the User's rating of a song and handles creating a new Interaction if needed. 
function UpdateRating( object, val, prevRate ){
	 $.ajax({
	 	type: 'POST',
        url: 'Scripts/update.php?' + window.location.search.substring( 1 ),
        data: '&content=' + object.value + '&new=' + val + '&prevRate=' + prevRate,
        cache: false,
        error: function( e ){
            alert( e );
        },
        success: function( response ){
            alert( response );
            $.ajax({
                type: 'POST',
                url: 'Scripts/update.php?' + window.location.search.substring( 1 ),
                data: '&update=' + true,
                cache: false,
                error: function( e ){
                    alert( e );
                },
                success: function( response ){
                    document.getElementById( 'rate' ).innerHTML = response;
                }
            }); 
        }
    }); 
};

//Adds songs to playlist and handles creating new playlists
function updatePlaylists( songid ){
 $.ajax({
        type: 'POST',
        url: 'Scripts/update.php?',
        data: 'songid=' + songid,
        cache: false,
        error: function( e ){
            alert( e );
        },
        success: function( response ){

            //If user has no playlists, this handles the creation of a new one and adds the song to it.
            if( response == 'No Playlists Created' ){
                alert( response );
                var pro = prompt( "Enter a name to create a new playlist: ", "Playlist" );
                if( pro != null ){
                $.ajax({
                    type: 'POST',
                    url: 'Scripts/update.php?',
                    data: 'pname=' + pro + '&sid=' + songid,
                    cache: false,
                    error: function( e ){
                    alert( e );
                    },
                    success: function( response2 ){
                    alert( response2 );
                    }
                }); 
            	}
            }
            //If the User has playlists;
            else{

                var lists =  new Array();
                lists = response.split("*|*|*");

                //The the user only has one playlist, add the song to it.
                if( lists.length == 1 ){ 
                    var res = confirm( "Click Yes to Add Song to Existing Playlist. \n Click Cancel For Options.");
                        if( res  == true ){
                            $.ajax({
                                type: 'POST',
                                url: 'Scripts/update.php?',
                                data: 'playlist=' + lists[0] + '&s=' + songid,
                                cache: false,
                                error: function( e ){
                                alert( e );
                                },
                                success: function( response2 ){
                                alert( response2 );
                                }
                            });
                        }
                        else{
                            var res2 = confirm( "Click Yes to create New Playlist for Song. \n Click Cancel to Cancel" );
                            if( res2 == true ){
                                //create playlist and add song
                                var promp = prompt( "Enter a name to create a new playlist: ", "Playlist" );
                                $.ajax({
                                    type: 'POST',
                                    url: 'Scripts/update.php?',
                                    data: 'pname=' + promp + '&sid=' + songid,
                                    cache: false,
                                    error: function( e ){
                                    alert( e );
                                    },
                                    success: function( response3 ){
                                    alert( response3 );
                                    }
                                 }); 
                            }
                            else{
                                alert( "Song not added to Playlists" );
                            }
                        }
                }
                //If the user has more than one playlist to choose from
                else{
                    alert( "Please Allow Pop-Ups to Add to a Playlist!" );

                    //Put the playlist array and songid in local storage for use on next page
                    window.localStorage.setItem( "lists", JSON.stringify( lists ) );
                    window.localStorage.setItem( "song", songid );

                    //Open a new window for playlist selection
                    window.open( 'http://cs445.cs.umass.edu/php-wrapper/clp/existingPlaylist.php','name','height=500,width=600' );
                  
                }

                
                
            }
        }
    }); 


};
