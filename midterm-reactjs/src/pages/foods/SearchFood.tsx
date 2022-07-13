import axios from "axios";
import { useEffect, useState } from "react";
import { Link, useSearchParams } from "react-router-dom";
import { API_URL, FOODS_TABLE_NAME } from "../../utils/constants";
import { Food } from "../../utils/types";

const SearchFood = () => {
  const [searchParams] = useSearchParams();
  const searchKeys = {
    name: searchParams.get("name"),
    priceFrom: searchParams.get("priceFrom"),
    priceTo: searchParams.get("priceTo"),
  };
  const [foodList, setFoodList] = useState<Food[] | []>([]);
  const getFoodList = async () => {
    const res = await axios.get(API_URL + FOODS_TABLE_NAME);
    setFoodList(res.data.data);
  };
  useEffect(() => {
    getFoodList();
  }, []);
  const filteredFoodList = 
            foodList
            .filter((food) =>
              searchKeys.name
                ? food.name
                    .toLocaleLowerCase()
                    .includes(searchKeys.name.toLocaleLowerCase())
                : true
            )
            .filter((food) =>
              searchKeys.priceFrom
                ? food.price >= Number(searchKeys.priceFrom)
                : true
            )
            .filter((food) =>
              searchKeys.priceTo
                ? food.price <= Number(searchKeys.priceTo)
                : true
            )
            
  return (
    <>
      <div className="text-start my-3">
        <Link to="/Foods">
          <i className="fa fa-arrow-left" aria-hidden="true"></i>
        </Link>
      </div>
      <table className="table">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Image</th>
            <th scope="col">Description</th>
            <th scope="col">Ingedients</th>
          </tr>
        </thead>
        <tbody>
          {filteredFoodList.length ? (
            filteredFoodList.map((food) => (
              <tr>
                <td>{food.id}</td>
                <td>{food.name}</td>
                <td>{food.price}</td>
                <td>
                  <img
                    src={food.img}
                    style={{ width: "5rem", height: "5rem" }}
                    alt=""
                  />
                </td>
                <td>{food.description}</td>
                <td>{food.ingredients}</td>
              </tr>
            ))
          ) : (
            <tr>
              <td colSpan={5}>No data has found!</td>
            </tr>
          )}
        </tbody>
      </table>
    </>
  );
};
export default SearchFood;
