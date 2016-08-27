<?php 
class recipes_controller extends base_controller {

    public function __construct() {
        
        parent::__construct();
        
    }   # End of Method


    public function by_color($id=NULL) {
        
        # All Recipes that match the chosen color

        # Set Up View
            $this->template->content = View::instance('v_recipes_by_color');
            $this->template->title   = "Search for Juices By Color";
        
        # This selects all Recipes that match chosen color
            $q = "SELECT DISTINCT
                        recipes.recipe_id,
                        recipes.title,
                        recipes.author,
                        recipes.servings,
                        recipes.description,
                        colors.color,
                        recipes.color_id
                    FROM (colors INNER JOIN recipes 
                    ON colors.color_id = recipes.color_id) 
                    WHERE (((recipes.color_id)='$id'))";
                

        # Find recipes in DB
            $recipes = DB::instance(DB_NAME)->select_rows($q);

        # Send DB rows to Views
            if($recipes) {
                $this->template->content->recipes = $recipes;
            } else {
                $this->template->content->message = true;
            }

        # Render template
            echo $this->template;
        
    }   # End of Method

    public function by_search() {
        
        # All Recipes that match the keyword in search field

        # Set Up View
            $this->template->content = View::instance('v_recipes_by_search');
            $this->template->title   = "Search for Juices";

            if(!$_POST['search_term']) {
                $this->template->content->message = true;
                echo $this->template;
                return;
            }

        # Sanitize 
            $_POST = DB::instance(DB_NAME)->sanitize($_POST);
       
        # Assign search term to variable
            $keyword= $_POST['search_term'];

        # This selects all Recipes that have the keyword from search field
            $q = "SELECT recipes.recipe_id, 
                        recipes.title,
                        recipes.author,
                        recipes.description,
                        recipes.servings,
                        colors.color
                    FROM (colors INNER JOIN recipes
                    ON colors.color_id = recipes.color_id) 
                    INNER JOIN (ingredients 
                    INNER JOIN recipes_ingredients ON 
                        ingredients.ingredient_id = recipes_ingredients.ingredients_id)
                    ON recipes.recipe_id = recipes_ingredients.recipe_id
                    WHERE (((ingredients.ingredient) LIKE '%$keyword%'))";


        # Find recipes in DB
            $recipes = DB::instance(DB_NAME)->select_rows($q);
        
        # Send DB rows to Views
            if($recipes) {
                $this->template->content->recipes = $recipes;
            } else {
                $this->template->content->message = true;
            }

        # Render template
            echo $this->template;
        
    }   # End of Method

    public function display_recipe($id=Null){

        # Set Up View
            $this->template->content = View::instance('v_recipes_display_recipe');

        # This selects all Recipes that match chosen recipe
            $q = "SELECT 
                    recipes.recipe_id,
                    recipes.title, 
                    recipes.servings,
                    recipes.author, 
                    recipes.description, 
                    colors.color
                FROM colors INNER JOIN recipes ON
                    colors.color_id = recipes.color_id
                WHERE (((recipes.recipe_id)='$id'))";
                
        # Find recipes in DB
            $recipes = DB::instance(DB_NAME)->select_row($q);

        # This selects all Ingredients that match chosen recipe
            $q = "SELECT 
                    ingredients.ingredient, 
                    recipes_ingredients.quantity, 
                    recipes_ingredients.recipe_id
                FROM ingredients INNER JOIN recipes_ingredients ON
                    ingredients.ingredient_id = 
                    recipes_ingredients.ingredients_id
                WHERE (((recipes_ingredients.recipe_id)='$id'));";
                

        # Find recipes in DB
            $ingredients = DB::instance(DB_NAME)->select_rows($q);
        
        # This selects all Steps that match chosen recipe
            $q = "SELECT 
                    steps.step, 
                    recipes_steps.recipe_id
                FROM (step_num INNER JOIN steps ON 
                    step_num.step_num_id = steps.step_num_id) 
                INNER JOIN recipes_steps ON steps.step_id = 
                    recipes_steps.step_id
                WHERE (((recipes_steps.recipe_id)='$id'))
                ORDER BY step_num.step_num_id;";
                

        # Find recipes in DB
            $steps = DB::instance(DB_NAME)->select_rows($q);

        # Send DB rows to Views
            if($recipes) {
                $this->template->title   = $recipes['title'];
                $this->template->content->recipes = $recipes;
            } else {
                $this->template->content->message = true;
            }

            if($ingredients) {
                $this->template->content->ingredients = $ingredients;
            }

            if($steps) {
                $this->template->content->steps = $steps; 
            }


        # Build the query to figure out what connections does this user already have? 
        # I.e. what recipes do they like
            if($this->user) {
                $q = "SELECT * 
                    FROM users_recipes
                    WHERE recipe_id = '$id'
                    AND user_id = ".$this->user->user_id;

                # Store our results in the variable $connections
                    $connections = DB::instance(DB_NAME)->select_row($q);
            
                # Pass data (Connections) to the view
                    $this->template->content->connections = $connections;
            }
        # Render template
            echo $this->template;
        
    }   # End of Method
    
    public function print_recipe($id=NULL){
        
        # Set Up View
            $this->print_template->content = View::instance('v_recipes_print_recipe');

        # This selects all Recipes that match chosen recipe
            $q = "SELECT 
                    recipes.recipe_id,
                    recipes.title, 
                    recipes.author, 
                    recipes.description, 
                    recipes.servings,
                    colors.color
                FROM colors INNER JOIN recipes ON
                    colors.color_id = recipes.color_id
                WHERE (((recipes.recipe_id)='$id'))";
                

        # Find recipes in DB
            $recipes = DB::instance(DB_NAME)->select_row($q);

        # This selects all Ingredients that match chosen recipe
            $q = "SELECT 
                    ingredients.ingredient, 
                    recipes_ingredients.quantity, 
                    recipes_ingredients.recipe_id
                FROM ingredients INNER JOIN recipes_ingredients ON
                    ingredients.ingredient_id = 
                    recipes_ingredients.ingredients_id
                WHERE (((recipes_ingredients.recipe_id)='$id'));";
                

        # Find recipes in DB
            $ingredients = DB::instance(DB_NAME)->select_rows($q);
        
        # This selects all Steps that match chosen recipe
            $q = "SELECT 
                    steps.step, 
                    recipes_steps.recipe_id
                FROM (step_num INNER JOIN steps ON 
                    step_num.step_num_id = steps.step_num_id) 
                INNER JOIN recipes_steps ON steps.step_id = 
                    recipes_steps.step_id
                WHERE (((recipes_steps.recipe_id)='$id'))
                ORDER BY step_num.step_num_id;";
                

        # Find recipes in DB
            $steps = DB::instance(DB_NAME)->select_rows($q);

        # Send DB rows to Views
            if($recipes) {
                $this->print_template->title   = $recipes['title'];
                $this->print_template->content->recipes = $recipes;
            } else {
                $this->print_template->content->message = true;
            }

            if($ingredients) {
                $this->print_template->content->ingredients = $ingredients;
            }

            if($steps) {
                $this->print_template->content->steps = $steps; 
            }

        # Render template
            echo $this->print_template;
        

    } # End of Method

    public function my_recipes() {
    
        # Make sure User is logged in or redirect to login page
            if(!$this->user) {
                Router::redirect("/users/login");
            }
              
        # All Recipes that logged in user has liked

        # Set Up View
            $this->template->content = View::instance('v_recipes_my_recipes');
            $this->template->title   = "My Juices";

        # Create variable to reference logged in user in query
            $this_user_id = $this->user->user_id;

        # This selects all the Red Recipes that the logged in user has liked
            $q = "SELECT recipes.recipe_id,
                         recipes.title, 
                         recipes.author, 
                         recipes.description, 
                         recipes.color_id,
                         colors.color, 
                         users_recipes.user_id
                    FROM (users 
                    INNER JOIN (colors 
                    INNER JOIN recipes 
                    ON colors.color_id = recipes.color_id) 
                    ON users.user_id = recipes.user_id) 
                    INNER JOIN users_recipes 
                    ON (users.user_id = users_recipes.user_id) 
                    AND (recipes.recipe_id = users_recipes.recipe_id)
                    WHERE (((recipes.color_id)=4) AND ((users_recipes.user_id)='$this_user_id'));";

        # Find recipes in DB
            $red_recipes = DB::instance(DB_NAME)->select_rows($q);
        
        # Send DB rows to Views
            if($red_recipes) {
                $this->template->content->red_recipes = $red_recipes;
            } else {
                $this->template->content->red_message = true;
            }

        # This selects all the Orange Recipes that the logged in user has liked
            $q = "SELECT recipes.recipe_id,
                         recipes.title, 
                         recipes.author, 
                         recipes.description, 
                         recipes.color_id,
                         colors.color, 
                         users_recipes.user_id
                    FROM (users 
                    INNER JOIN (colors 
                    INNER JOIN recipes 
                    ON colors.color_id = recipes.color_id) 
                    ON users.user_id = recipes.user_id) 
                    INNER JOIN users_recipes 
                    ON (users.user_id = users_recipes.user_id) 
                    AND (recipes.recipe_id = users_recipes.recipe_id)
                    WHERE (((recipes.color_id)=3) AND ((users_recipes.user_id)='$this_user_id'));";

        # Find recipes in DB
            $orange_recipes = DB::instance(DB_NAME)->select_rows($q);
        
        # Send DB rows to Views
            if($orange_recipes) {
                $this->template->content->orange_recipes = $orange_recipes;
            } else {
                $this->template->content->orange_message = true;
            }    
        
        # This selects all the Yellow Recipes that the logged in user has liked
            $q = "SELECT recipes.recipe_id,
                         recipes.title, 
                         recipes.author, 
                         recipes.description, 
                         recipes.color_id,
                         colors.color, 
                         users_recipes.user_id
                    FROM (users 
                    INNER JOIN (colors 
                    INNER JOIN recipes 
                    ON colors.color_id = recipes.color_id) 
                    ON users.user_id = recipes.user_id) 
                    INNER JOIN users_recipes 
                    ON (users.user_id = users_recipes.user_id) 
                    AND (recipes.recipe_id = users_recipes.recipe_id)
                    WHERE (((recipes.color_id)=2) AND ((users_recipes.user_id)='$this_user_id'));";

        # Find recipes in DB
            $yellow_recipes = DB::instance(DB_NAME)->select_rows($q);
        
        # Send DB rows to Views
            if($yellow_recipes) {
                $this->template->content->yellow_recipes = $yellow_recipes;
            } else {
                $this->template->content->yellow_message = true;
            }

        # This selects all the Green Recipes that the logged in user has liked
            $q = "SELECT recipes.recipe_id,
                         recipes.title, 
                         recipes.author, 
                         recipes.description, 
                         recipes.color_id,
                         colors.color, 
                         users_recipes.user_id
                    FROM (users 
                    INNER JOIN (colors 
                    INNER JOIN recipes 
                    ON colors.color_id = recipes.color_id) 
                    ON users.user_id = recipes.user_id) 
                    INNER JOIN users_recipes 
                    ON (users.user_id = users_recipes.user_id) 
                    AND (recipes.recipe_id = users_recipes.recipe_id)
                    WHERE (((recipes.color_id)=1) AND ((users_recipes.user_id)='$this_user_id'));";

        # Find recipes in DB
            $green_recipes = DB::instance(DB_NAME)->select_rows($q);
        
        # Send DB rows to Views
            if($green_recipes) {
                $this->template->content->green_recipes = $green_recipes;
            } else {
                $this->template->content->green_message = true;
            }

        # This selects all the Purple Recipes that the logged in user has liked
            $q = "SELECT recipes.recipe_id,
                         recipes.title, 
                         recipes.author, 
                         recipes.description, 
                         recipes.color_id,
                         colors.color, 
                         users_recipes.user_id
                    FROM (users 
                    INNER JOIN (colors 
                    INNER JOIN recipes 
                    ON colors.color_id = recipes.color_id) 
                    ON users.user_id = recipes.user_id) 
                    INNER JOIN users_recipes 
                    ON (users.user_id = users_recipes.user_id) 
                    AND (recipes.recipe_id = users_recipes.recipe_id)
                    WHERE (((recipes.color_id)=5) AND ((users_recipes.user_id)='$this_user_id'));";

        # Find recipes in DB
            $purple_recipes = DB::instance(DB_NAME)->select_rows($q);
        
        # Send DB rows to Views
            if($purple_recipes) {
                $this->template->content->purple_recipes = $purple_recipes;
            } else {
                $this->template->content->purple_message = true;
            }
        # Render template
            echo $this->template;

    }   # End of Method

    public function follow($recipe_id) {

        # Like a Recipe

        # Prepare the data array to be inserted
            $data = Array (
                "user_id" => $this->user->user_id,
                "recipe_id" => $recipe_id
                );

        # Insert
            DB::instance(DB_NAME)->insert('users_recipes', $data);

        # Send them back to view of Woofers
            Router::redirect("/recipes/display_recipe/$recipe_id");

    }   # End of Method

    public function unfollow($recipe_id) {
        
        # Unlike a Recipe
        
        # Delete this connection
            $where_condition = 'WHERE user_id = '.$this->user->user_id.'
                                AND recipe_id = '.$recipe_id;
            DB::instance(DB_NAME)->delete('users_recipes', $where_condition);

        # Send them back to Recipe
            Router::redirect("/recipes/display_recipe/$recipe_id");

    }   # End of Method
        
}   # End of Class