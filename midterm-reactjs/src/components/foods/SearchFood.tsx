import axios from "axios";
import { useEffect, useState } from "react";
import { Link, useSearchParams } from "react-router-dom";
import { API_URL, FOODS_TABLE_NAME, SEARCH } from "../../utils/constants";
import { Food } from "../../utils/types";

const SearchFood = () => {
  const [searchParams] = useSearchParams();
  const searchKeys = {
    name: searchParams.get("name"),
    priceFrom: searchParams.get("priceFrom"),
    priceTo: searchParams.get("priceTo"),
  };
  const [data, setData] = useState<{results: Food[] | [], count: 0}>({
    results: [],
    count: 0
  });
  
  useEffect(() => {
    const getResults = async () => {
      const res = await axios.get(
        API_URL +
          FOODS_TABLE_NAME +
          SEARCH +
          `?name=${searchKeys.name}&priceFrom=${searchKeys.priceFrom}&priceTo=${searchKeys.priceTo}`
      );
      setData({ count: res.data.count, results: res.data.results });
    };
    getResults();
  }, [searchKeys.name, searchKeys.priceFrom, searchKeys.priceTo]);       
  console.log(data);
     
  return (
    <>
      <div className="text-startfilteredFoodList.length my-3">
        <Link to="/Foods">
          <i className="fa fa-arrow-left" aria-hidden="true"></i>
        </Link>
      </div>
      <table className="table">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Price (đ)</th>
            <th scope="col">Image</th>
            <th scope="col">Description</th>
            <th scope="col">Ingedients</th>
          </tr>
        </thead>
        <tbody>
          {data.count ? (
            data.results.map((food, index) => (
              <tr key={index}>
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
