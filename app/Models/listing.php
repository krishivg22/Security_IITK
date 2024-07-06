<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class listing extends Model    #iss model me saare wo methods hai jo hume chahiye honge
{
    use HasFactory;
    // protected $fillable=['title','tags','description','location','email','website','company'];  #All these properties are filllable in the database...but instead you can unguard the model in App service provider.
    public function scopefiLteR($query, array $filters){       #scopefiLteR  Naam ye hi rkhna padega capital/small kuch bhi
        if($filters['tag'] ?? FALSE){
            $tag=$filters['tag'];
            $query->where('tags', 'like', '%,' . $tag . ',%')
            ->orWhere('tags', 'like', $tag . ',%')
            ->orWhere('tags', 'like', '%,' . $tag)
            ->orWhere('tags', '=', $tag);                                 #SQL like query: searches in tags column,and filters those listings which have this tag in it. Returns final filtered list at function end.'%' represent aage piche kuch bhi hoga.
        }                   #The ?? operator is the null coalescing operator, introduced in PHP 7. It returns the value of its left-hand operand if it exists and is not null, otherwise, it returns the right-hand operand.
        if($filters['search'] ?? FALSE){
            $titlePosition = strpos($filters['search'], 'title');
            $k=0;
            if ($titlePosition !== false){
                $k=1;
    $startPosition = $titlePosition + strlen('title:')  ; 
    $commaPosition = strpos($filters['search'], ',',$startPosition);
    $searchTerm = substr($filters['search'], $startPosition, $commaPosition-$startPosition);
    $query->where('title','like','%'.$searchTerm.'%') ;
            }
            $reporterPosition = strpos($filters['search'], 'reporter');
if ($reporterPosition !== false){
    $k=1;
$startPosition = $reporterPosition + strlen('reporter:')  ; 
$commaPosition = strpos($filters['search'], ',',$startPosition);
$searchTerm = substr($filters['search'], $startPosition, $commaPosition-$startPosition);
$query->where('reporter','like','%'.$searchTerm.'%') ;
}
            $tagsPosition = strpos($filters['search'], 'tags');
            if ($tagsPosition !== false){
                $k=1;
    $startPosition = $tagsPosition + strlen('tags:')  ; 
    $commaPosition = strpos($filters['search'], ',',$startPosition);
    $searchTerm = substr($filters['search'], $startPosition, $commaPosition-$startPosition);
    $query->where('tags','like','%'.$searchTerm.'%') ;
            }
            $datePosition = strpos($filters['search'], 'date');
            if ($datePosition !== false){
                $k=1;
    $startPosition = $datePosition + strlen('date:')  ; 
    $commaPosition = strpos($filters['search'], ',',$startPosition);
    $searchTerm = substr($filters['search'], $startPosition, $commaPosition-$startPosition);
    $query->where('date','like','%'.$searchTerm.'%') ;
            }
            $statusPosition = strpos($filters['search'], 'status');
            if ($statusPosition !== false){
                $k=1;
    $startPosition = $statusPosition + strlen('status:')  ; 
    $commaPosition = strpos($filters['search'], ',',$startPosition);
    $searchTerm = substr($filters['search'], $startPosition, $commaPosition-$startPosition);
    $query->where('status','like','%'.$searchTerm.'%') ;
            }
            if($k==0){
                $query->where('title','like','%'.$filters['search'].'%')
                ->orWhere('tags','like','%'.$filters['search'].'%') #teeno me jo mile sbka union le liya jayega.
                ->orWhere('status','like','%'.$filters['search'].'%');
            }
        } 
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
