import { Outlet } from "react-router-dom";
import { SearchBar } from "../../components/foods";
import SearchFood from "../../components/foods/SearchFood";

const FoodPage = () => {
  return (
    <div className="container-fluid">
      <div className="row">
        <div className="col-9">
          <h1 className="text-center">MENU</h1>
          <Outlet />
        </div>
        <div className="col-3" style={{ marginTop: "10vh"}}>
          <SearchBar />
        </div>
      </div>
    </div>
  );
};
export default FoodPage;
export { SearchFood };
