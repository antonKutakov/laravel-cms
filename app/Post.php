<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Auth;

class Post extends Model
{
    use Sluggable;

    const IS_DRAFT      = 0;
    const IS_PUBLIC     = 1;
    const IS_STANDART   = 0;
    const IS_FEATURED   = 1;

    protected $fillable = ['title', 'content', 'date', 'description'];

    public $timestamps = true;
    
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function tags(){
        return $this->belongsToMany(
            Tag::class,
            'post_tags',
            'post_id',
            'tag_id'
        );
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function add($fields){
        $post = new static;
        $post->fill($fields);
        $post->user_id = Auth::user()->id;
        $post->save();
        return $post;
    }

    public function edit($fields){
        $this->fill($fields);
        $this->save();
    }
    public function removeImage(){
        if($this->image != null)
        {
            Storage::delete('uploads/' . $this->image);
        }
    }

    public function remove(){
        $this->removeImage();
        $this->delete();
    }

    public function uploadImage($image){
        if($image == null){
            return;
        } 
        $this->removeImage();      
        $filename = str_random(10).'.'.$image->extension();
        $image->storeAs('uploads', $filename);
        $this->image = $filename;
        $this->save();
    }

    public function setCategory($id){
        if($id == null){
            return;
        } 
        $this->category_id = $id;
    	$this->save();
    }

    public function setTags($ids){
        if($ids == null){
            return;
        } 
        $this->tags()->sync($ids);
    }

    public function setDraft(){
        $this->status = Post::IS_DRAFT;
        $this->save();
    }

    public function setPublic(){
        $this->status = Post::IS_PUBLIC;
        $this->save();
    }

    public function toggleStatus($value){
        if($value == null){
            return $this->setDraft();
        }
        return $this->setPublic();
    }

    public function setStandart(){
        $this->is_featured = Post::IS_STANDART;
        $this->save();
    }

    public function setFeatured(){
        $this->is_featured = Post::IS_FEATURED;
        $this->save();
    }

    public function toggleFeatured($value){
        if($value == null){
            return $this->setStandart();
        }
        return $this->setFeatured();
    }

    public function getImage(){
        if($this->image == null){
            return '/img/no-image.png';
        }
        return '/uploads/'.$this->image;
    }

    public function getCategoryTitle(){
        if($this->category != null){
            return $this->category->title;
        }
        return "Без категории";
    }

    public function getTagsTitles(){
        if(!$this->tags->isEmpty()){
            return implode(', ',$this->tags->pluck('title')->all());
        }
        return 'Нет тегов';
    }

    public function getCategoryID(){
        return $this->category != null ? $this->category->id : null;
    }

    public function hasPrevious(){
        return self::where('id', '<', $this->id)->max('id');
    }

    public function getPrevious(){
        $postID = $this->hasPrevious(); //id
        return self::find($postID);
    }

    public function hasNext(){
        return self::where('id', '>', $this->id)->min('id');
    }

    public function getNext(){
        $postID = $this->hasNext();
        return self::find($postID);
    }

    public function related(){
       return self::all()->except($this->id);
    }

    public function hasCategory(){
        return $this->category != null ? true :false;
    }

    public function getComments(){
        return $this->comments()->where('status', 1)->get();
    }

}
