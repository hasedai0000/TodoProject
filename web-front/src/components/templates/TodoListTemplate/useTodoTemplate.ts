/**
 * useTodoTemplate
 *
 * @package hooks
 */

import { EventType } from '@/interfaces/Event';
import { TodoType } from '@/interfaces/Todo';
import { useCallback, useMemo, useState } from 'react';

type Params = {
  originTodoList: Array<TodoType>;
};

type StatesType = {
  searchKeyword: string;
  showTodoList: Array<TodoType>;
};

type ActionsType = {
  handleChangeSearchWord: EventType['onChangeInput'];
};

export const useTodoTemplate = ({ originTodoList }: Params) => {
  // 検索キーワード
  const [searchKeyword, setSearchKeyword] = useState('');
  // 表示用TodoList
  const showTodoList = useMemo(() => {
    const regexp = new RegExp('^' + searchKeyword, 'i');
    return originTodoList?.filter((todo) => {
      // 検索キーワードに部分一致したTodoだけを一覧表示する
      return todo.title.match(regexp);
    });
  }, [originTodoList, searchKeyword]);

  // 検索キーワードを変更する
  const handleChangeSearchWord: EventType['onChangeInput'] = useCallback((e) => {
    setSearchKeyword(e.target.value);
  }, []);

  const states: StatesType = {
    searchKeyword,
    showTodoList,
  };

  const actions: ActionsType = {
    handleChangeSearchWord,
  };

  return { states, actions } as const;
};
