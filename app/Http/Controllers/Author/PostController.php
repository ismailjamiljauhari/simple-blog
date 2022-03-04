<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{   
    /** 
     * Query builder
     * 
     * @var string
     */
    protected $query;

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->datatableColumns = [
            'formatted_id',
            'action',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['table'] = [
            'table_url' => route('posts.data'),
            'create' => [
                'url' => route('posts.create'),
                'label' => 'Add Post',
            ],
            'columns' => [
                [
                    'name' => 'formatted_id',
                    'label' => 'ID',
                ],
                [
                    'name' => 'title',
                    'label' => 'Title',
                ],
                [
                    'name' => 'action',
                    'label' => '#',
                ],
            ]
        ];

        return view('author.post.index', $data);
    }

    /**
     * Get Datatable data
     * 
     * @return Datatable
     */
    public function getDatatable()
    {
        $query = $this->getQuery()->orderBy('id', 'desc');

        $datatables = Datatables::of($query);
        
        foreach($this->datatableColumns as $column) {
            $datatables->addColumn($column, function($item) use($column){
                switch ($column) {
                    case 'formatted_id':
                        return '<strong>' . $item->{$column} . '</strong>'; 
                        break;
                    case 'action':
                        $string = '';
                        $string .= '<a href="' . route('posts.edit', $item->id) . '"><button title="Edit" class="btn btn-icon btn-sm btn-success waves-effect waves-light" style="margin-right: 5px;"><i class="fa fa-eye"></i></button></a>';    
                        $string .= '<button title="Hapus" class="btn btn-icon btn-sm btn-danger waves-effect waves-light delete"><i class="fa fa-trash"></i></button>';
                        $string .= '<form action="' . route('posts.destroy', $item->id) . '" method="POST">' . method_field('delete') . csrf_field() . '</form>';

                        return $string;
                        break;
                    default:
                        return $item->{$column};
                        break;
                }

            });
        }

        return $datatables->rawColumns($this->datatableColumns)->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['fields'] = $this->getFormData();

        return view('author.post.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $payload = $this->preparePayload($request);
        $post = $this->getQuery()->create($payload);

        return redirect()->route('posts.index')->with('status', $this->messageSaved);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['fields'] = $this->getFormData();
        $data['object'] = $this->getQuery()->findOrFail($id);

        return view('author.post.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $payload = $this->preparePayload($request);
        $post = $this->getQuery()->findOrFail($id);
        $post->update($payload);

        return redirect()->route('posts.index')->with('status', $this->messageSaved);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = $this->getQuery()->findOrFail($id);
        $post->delete();

        return redirect()->back()->with('status', $this->messageDeleted);
    }

    /**
     * Prepare payload
     * 
     * @param array $request
     * 
     * @return array
     */
    public function preparePayload($request)
    {
        $payload = $request->only([
            'title',
            'content',
            'category',
            'publish_at',
            'image',
        ]);

        return $payload;
    }

    /** 
     * Get Query
     * 
     * @return query
     */
    public function getQuery()
    {
        return request()->user()->posts();
    }

    /**
     * Get Form Data
     * 
     * @return array
     */
    public function getFormData()
    {
        $data = Post::mappingFieldForm();
        
        return $data;
    }
}
