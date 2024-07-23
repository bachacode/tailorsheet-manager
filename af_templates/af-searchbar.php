<div class="search">
    <input type="text" class="searchTerm" placeholder="Buscar una expresión">
    <button type="submit" class="searchButton">
    <i class="fa fa-search"></i>
    </button>
</div>


<style scoped>
    @import url(https://fonts.googleapis.com/css?family=Open+Sans);

    .search {
    width: 100%;
    position: relative;
    display: flex;
    color: black;
    }

    input[type='text'].searchTerm {
    width: 100%;
    border: 3px solid #00B4CC;
    border-right: none;
    padding: 5px;
    height: 36px;
    border-radius: 5px 0 0 5px;
    outline: none;
    color: black;
    }

    .searchButton {
    width: 40px;
    height: 36px;
    border: 1px solid #00B4CC;
    background: #00B4CC;
    text-align: center;
    color: #fff;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
    font-size: 20px;
    }
</style>