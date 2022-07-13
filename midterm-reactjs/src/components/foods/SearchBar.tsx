import { ChangeEvent, FormEvent, useState } from "react";
import { useNavigate } from "react-router-dom";

const SearchBar = () => {
  const [searchKey, setSearchKey] = useState<{name: string, priceFrom: string, priceTo: string}>({
    name: "",
    priceFrom: "",
    priceTo: ""

  });
  const navigate = useNavigate();
  const submitHandler = (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();

    navigate({ pathname: "/Foods/Search", search: `?name=${searchKey.name}&priceFrom=${searchKey.priceFrom}&priceTo=${searchKey.priceTo}`});
  };
  const inputChangeHandler = (e: ChangeEvent<HTMLInputElement>) => {
    setSearchKey({...searchKey, [e.target.name]: e.target.value})
  }
  return (
    <> 
    <h4 className="text-center fw-bold">Search</h4>
      <form
        className="d-flex flex-column"
        role="search"
        onSubmit={submitHandler}
      >
        Name:
        <input
          className="form-control me-2"
          type="search"
          name="name"
          value={searchKey.name}
          placeholder="Search"
          onChange={inputChangeHandler}
        />
        <br />
        Price:
        <input
          type="number"
          value={searchKey.priceFrom}
          className="form-control"
          placeholder="Enter price from"
          name="priceFrom"
          onChange={inputChangeHandler}
        />{" "}
        <br />
        <input
          type="number"
          name="priceTo"
          value={searchKey.priceTo}
          className="form-control"
          placeholder="Enter price to"
          onChange={inputChangeHandler}
        />
        <button className="btn btn-outline-success mt-3" type="submit">
          Search
        </button>
      </form>
    </>
  );
};
export default SearchBar;
